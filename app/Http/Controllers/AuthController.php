<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use App\Validator\AuthValidator;

class AuthController extends Controller
{

    /**
     * @var RolValidator
     */
    private $validator;

    public function __construct(AuthValidator $validator,  Request $request)
    {
        $this->validator = $validator;
        $this->request = $request;
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // Check if field is not empty
        if (empty($email) or empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'You must fill all fields']);
        }

        $client = new Client();

        try {
            return $client->post(config('service.passport.login_endpoint'), [
                "form_params" => [
                    "client_secret" => config('service.passport.client_secret'),
                    "grant_type" => "password",
                    "client_id" => config('service.passport.client_id'),
                    "username" => $request->email,
                    "password" => $request->password
                ]
            ]);
        } catch (BadResponseException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function registerAdmin()
    {
        $request = $this->request;
        $requestData = $request->all();

        $validator = $this->validator->validate();

        if ($validator->fails()) {
            return response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        }

        // Create new user
        try {
            $user = new User();

            $requestData['password'] = app('hash')->make($request->password);

            $user->create($requestData);

            // if ($user->save()) {
            //     // Will call login method
            //     return $this->login($request);
            // }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // REGISRO DE CLIENTE ESPECIFICANDO EL ID_ROL = IDCLIENTE
    public function registerCustomer()
    {
        $request = $this->request;
        $requestData = $request->all();

        $validator = $this->validator->validate();

        if ($validator->fails()) {
            return response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        }

        // Create new user
        try {
            $user = new User();

            $requestData['password'] = app('hash')->make($request->password);
            $requestData['id_rol'] = 2;
            $user->create($requestData);

            // if ($user->save()) {
            //     // Will call login method
            //     return $this->login($request);
            // }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    public function logout()
    {
        try {
            auth()->user()->tokens()->each(function ($token) {
                $token->delete();
            });

            return response()->json(['status' => 'success', 'message' => 'Logged out successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}

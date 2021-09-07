<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Implementations\RolServiceImpl;
use App\Validator\RolValidator;
use ErrorException;

class RolController extends Controller
{
    /**
     * @var RolServiceImpl
     */
    private $rolService;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var RolValidator
     */
    private $validator;

    public function __construct(RolServiceImpl $rolService, Request $request, RolValidator $rolValidator)
    {
        $this->rolService = $rolService;
        $this->request = $request;
        $this->validator = $rolValidator;
    }

    function createRol()
    {
        $validator = $this->validator->validate();

        if ($validator->fails()) {
            $response = response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        } else {
            $this->rolService->postRol($this->request->all());
            $response = response($this->request, 202);
        }

        return $response;
    }
    function getListRol()
    {
        return response($this->rolService->getRol());
    }
    function getListRolNoDelete()
    {
        return response($this->rolService->getRolNoDelete());
    }
    function getListRolOnlyDelete()
    {
        return response($this->rolService->getRolOnlyDelete());
    }
    function putRol(int $id)
    {
        $response = response("", 202);

        $this->rolService->putRol($this->request->all(), $id);

        return $response;
    }
    function deleteRol(int $id)
    {

        try {
            $this->rolService->delRol($id);
            return response("", 204);
        } catch (ErrorException $exception) {
            return response("Inserte un ID válido", 400);
        }
    }
    function restoreRol(int $id)
    {
        $this->rolService->restoreRol($id);

        return response("", 204);
    }
}

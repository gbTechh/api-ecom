<?php

namespace App\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthValidator
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        return Validator::make($this->request->all(), $this->rules(), $this->messages());
    }

    private function rules()
    {
        return [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|max:80|min:6",
            "id_rol" => "required",

        ];
    }

    private function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'unique' => 'Ya existen un :attribute con ese nombre',
            'email' => 'Escriba un email valido',
            'max' => 'La contraseña no debe ser mayor a 80 caracteres',
            'min' => 'La contraseña no debe ser menor a 80 caracteres',
        ];
    }
}

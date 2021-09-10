<?php

namespace App\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionValidator
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
            "id_rol" => "required",
            "id_module" => "required",
            "r" => "required",
            "w" => "required",
            "u" => "required",
            "d" => "required",
        ];
    }

    private function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
        ];
    }
}

<?php

namespace App\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolValidator
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
            "name" => "required|unique:rols,name," . $this->request->id,
            "description" => "required"
        ];
    }

    private function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'unique' => 'Ya existen un :attribute con ese nombre'
        ];
    }
}

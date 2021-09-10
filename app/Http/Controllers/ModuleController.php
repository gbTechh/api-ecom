<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Implementations\ModuleServiceImpl;
use App\Validator\ModuleValidator;
use ErrorException;

class ModuleController extends Controller
{
    /**
     * @var RolServiceImpl
     */
    private $modulelService;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var ModuleValidator
     */
    private $validator;

    public function __construct(ModuleServiceImpl $moduleService, Request $request, ModuleValidator $moduleValidator)
    {
        $this->moduleService = $moduleService;
        $this->request = $request;
        $this->validator = $moduleValidator;
    }

    function createModule()
    {
        $validator = $this->validator->validate();

        if ($validator->fails()) {
            $response = response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        } else {
            $this->moduleService->postModule($this->request->all());
            $response = response($this->request, 202);
        }

        return $response;
    }
    function getListModule()
    {
        return response($this->moduleService->getModule());
    }
    function getListModuleNoDelete()
    {
        return response($this->moduleService->getModuleNoDelete());
    }
    function getListModuleOnlyDelete()
    {
        return response($this->moduleService->getModuleOnlyDelete());
    }
    function putModule(int $id)
    {
        $response = response("", 202);

        $this->moduleService->putModule($this->request->all(), $id);

        return $response;
    }
    function deleteModule(int $id)
    {

        try {
            $this->moduleService->delModule($id);
            return response("", 204);
        } catch (ErrorException $exception) {
            return response("Inserte un ID válido", 400);
        }
    }
    function restoreModule(int $id)
    {
        $this->moduleService->restoreModule($id);

        return response("", 204);
    }
}

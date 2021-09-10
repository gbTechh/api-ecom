<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Implementations\PermissionServiceImpl;
use App\Validator\PermissionValidator;
use ErrorException;

class PermissionController extends Controller
{
    /**
     * @var RolServiceImpl
     */
    private $permissionlService;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var PermissionValidator
     */
    private $validator;

    public function __construct(PermissionServiceImpl $permissionService, Request $request, PermissionValidator $permissionValidator)
    {
        $this->permissionService = $permissionService;
        $this->request = $request;
        $this->validator = $permissionValidator;
    }

    function createPermission()
    {
        $validator = $this->validator->validate();

        if ($validator->fails()) {
            $response = response([
                "status" => 422,
                "message" => "Error",
                "errors" => $validator->errors()
            ], 422);
        } else {
            $this->permissionService->postPermission($this->request->all());
            $response = response($this->request, 202);
        }

        return $response;
    }
    function getListPermission()
    {
        return response($this->permissionService->getPermission());
    }
    function getListPermissionNoDelete()
    {
        return response($this->permissionService->getPermissionNoDelete());
    }
    function getListPermissionOnlyDelete()
    {
        return response($this->permissionService->getPermissionOnlyDelete());
    }
    function putPermission(int $id)
    {
        $response = response("", 202);

        $this->permissionService->putPermission($this->request->all(), $id);

        return $response;
    }
    function deletePermission(int $id)
    {

        try {
            $this->permissionService->delPermission($id);
            return response("", 204);
        } catch (ErrorException $exception) {
            return response("Inserte un ID válido", 400);
        }
    }
    function restorePermission(int $id)
    {
        $this->permissionService->restorePermission($id);

        return response("", 204);
    }
}

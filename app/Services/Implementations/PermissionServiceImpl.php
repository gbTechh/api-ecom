<?php

namespace App\Services\Implementations;

use App\Models\Permission;
use App\Services\Interfaces\IPermissionServiceInterface;

class PermissionServiceImpl implements IPermissionServiceInterface
{
    private $model;

    function __construct()
    {
        $this->model = new Permission();
    }
    function getPermission()
    {
        return $this->model->withTrashed()->get();
    }
    function getPermissionNoDelete()
    {
        return $this->model->get();
    }
    function getPermissionOnlyDelete()
    {
        return $this->model->onlyTrashed()->get();
    }



    function getPermissionById(int $id)
    {
    }

    /**
     * Crea un nuevo Permission en la bd
     */
    function postPermission(array $permission)
    {
        $this->model->create($permission);
    }

    function putPermission(array $permission, int $id)
    {
        $id = $this->model->find($id);
        if ($id != null) {
            $this->model->where('id', $id)
                ->first()
                ->fill($permission)
                ->save();
        } else {
            throw new \InvalidArgumentException('ID no encontrado');
        }
    }

    function delPermission(int $id)
    {

        $permission = $this->model->find($id);

        if ($permission != null) {
            $permission->delete();
        } else {
            throw new \InvalidArgumentException('ID no encontrado');
        }
    }
    function restorePermission(int $id)
    {
        $permission = $this->model->withTrashed()->find($id);

        if ($permission != null) {
            $permission->restore();
        }
    }
}

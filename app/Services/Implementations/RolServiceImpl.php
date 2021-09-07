<?php

namespace App\Services\Implementations;

use App\Models\Rol;
use App\Services\Interfaces\IRolServiceInterface;

class RolServiceImpl implements IRolServiceInterface
{
    private $model;

    function __construct()
    {
        $this->model = new Rol();
    }
    function getRol()
    {
        return $this->model->withTrashed()->get();
    }
    function getRolNoDelete()
    {
        return $this->model->get();
    }
    function getRolOnlyDelete()
    {
        return $this->model->onlyTrashed()->get();
    }



    function getRolById(int $id)
    {
    }

    /**
     * Crea un nuevo rol en la bd
     */
    function postRol(array $rol)
    {
        $this->model->create($rol);
    }

    function putRol(array $rol, int $id)
    {
        $this->model->where('id', $id)
            ->first()
            ->fill($rol)
            ->save();
    }

    function delRol(int $id)
    {

        $rol = $this->model->find($id);

        if ($rol != null) {
            $rol->delete();
        } else {
            throw new \InvalidArgumentException('ID no encontrado');
        }
    }
    function restoreRol(int $id)
    {
        $rol = $this->model->withTrashed()->find($id);

        if ($rol != null) {
            $rol->restore();
        }
    }
}

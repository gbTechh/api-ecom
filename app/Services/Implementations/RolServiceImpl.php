<?php

namespace App\Services\Implementations;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Rol;
use App\Models\RolHasModule;
use App\Services\Interfaces\IRolServiceInterface;

class RolServiceImpl implements IRolServiceInterface
{
    private $model;

    function __construct()
    {
        $this->model = new Rol();
        $this->modelRolHasModule = new RolHasModule();
        $this->modelModule = new Module();
        $this->modelPermission = new Permission();
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
        $data = $this->model->create($rol);
        $idRol = $data->id;
        $arrayIdModule = $this->modelModule->select('id')->pluck('id')->toArray();
        $arrayModule = array();
        foreach ($arrayIdModule as $key) {

            $arrayModule['id_rol'] = $idRol;
            $arrayModule['id_module'] = $key;

            $dataInserted = $this->modelRolHasModule->create($arrayModule);
            $dataId['id_rol_has_module'] = $dataInserted->id;
            $this->modelPermission->create($dataId);
        }
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

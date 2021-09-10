<?php

namespace App\Services\Implementations;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Rol;
use App\Models\RolHasModule;
use App\Services\Interfaces\IModuleServiceInterface;

class ModuleServiceImpl implements IModuleServiceInterface
{
    private $model;
    private $modelRol;
    private $modelPermission;
    private $modelRolHasModule;

    function __construct()
    {
        $this->model = new Module();
        $this->modelRol = new Rol();
        $this->modelRolHasModule = new RolHasModule();
        $this->modelPermission = new Permission();
    }
    function getModule()
    {
        return $this->model->withTrashed()->get();
    }
    function getModuleNoDelete()
    {
        return $this->model->get();
    }
    function getModuleOnlyDelete()
    {
        return $this->model->onlyTrashed()->get();
    }



    function getModuleById(int $id)
    {
    }

    /**
     * Crea un nuevo Module en la bd
     */
    function postModule(array $module)
    {
        $data = $this->model->create($module);
        $idModule = $data->id;
        $arrayIdRoles = $this->modelRol->select('id')->pluck('id')->toArray();
        $arrayRoles = array();
        $dataId = array();
        foreach ($arrayIdRoles as $key) {

            $arrayRoles['id_rol'] = $key;

            $arrayRoles['id_module'] = $idModule;

            $dataInserted = $this->modelRolHasModule->create($arrayRoles);
            $dataId['id_rol_has_module'] = $dataInserted->id;
            if ($key == 1) {
                $dataId['r'] = 1;
                $dataId['w'] = 1;
                $dataId['d'] = 1;
                $dataId['u'] = 1;
            } else {
                $dataId['r'] = 0;
                $dataId['w'] = 0;
                $dataId['d'] = 0;
                $dataId['u'] = 0;
            }
            $this->modelPermission->create($dataId);
        }
    }

    function putModule(array $module, int $id)
    {
        $id = $this->model->find($id);
        if ($id != null) {
            $this->model->where('id', $id)
                ->first()
                ->fill($module)
                ->save();
        } else {
            throw new \InvalidArgumentException('ID no encontrado');
        }
    }

    function delModule(int $id)
    {

        $module = $this->model->find($id);

        if ($module != null) {
            $module->delete();
        } else {
            throw new \InvalidArgumentException('ID no encontrado');
        }
    }
    function restoreModule(int $id)
    {
        $module = $this->model->withTrashed()->find($id);

        if ($module != null) {
            $module->restore();
        }
    }
}

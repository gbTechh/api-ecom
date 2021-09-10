<?php

namespace App\Services\Implementations;

use App\Models\Module;
use App\Services\Interfaces\IModuleServiceInterface;

class ModuleServiceImpl implements IModuleServiceInterface
{
    private $model;

    function __construct()
    {
        $this->model = new Module();
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
        $this->model->create($module);
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

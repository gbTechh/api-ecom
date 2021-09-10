<?php

namespace APP\Services\Interfaces;

interface IModuleServiceInterface
{
    /**
     * @return array Module
     */
    function getModule();

    /**
     * @return array Module
     */
    function getModuleOnlyDelete();

    /**
     * @return array Module
     */
    function getModuleNoDelete();

    /**
     * @param int $id
     * @return User
     */
    function getModuleById(int $id);

    /**
     * @param array $module
     * @return void
     */
    function postModule(array $module);

    /**
     * @param array $module
     * @param int $id
     * @return void
     */
    function putModule(array $module, int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function delModule(int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function restoreModule(int $id);
}

<?php

namespace APP\Services\Interfaces;

interface IPermissionServiceInterface
{
    /**
     * @return array Module
     */
    function getPermission();

    /**
     * @return array Permission
     */
    function getPermissionOnlyDelete();

    /**
     * @return array Permission
     */
    function getPermissionNoDelete();

    /**
     * @param int $id
     * @return User
     */
    function getPermissionById(int $id);

    /**
     * @param array $ermission
     * @return void
     */
    function postPermission(array $permission);

    /**
     * @param array $permission
     * @param int $id
     * @return void
     */
    function putPermission(array $permission, int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function delPermission(int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function restorePermission(int $id);
}

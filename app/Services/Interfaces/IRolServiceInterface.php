<?php

namespace APP\Services\Interfaces;

interface IRolServiceInterface
{
    /**
     * @return array Rol
     */
    function getRol();

    /**
     * @return array Rol
     */
    function getRolOnlyDelete();

    /**
     * @return array Rol
     */
    function getRolNoDelete();

    /**
     * @param int $id
     * @return User
     */
    function getRolById(int $id);

    /**
     * @param array $rol
     * @return void
     */
    function postRol(array $rol);

    /**
     * @param array $rol
     * @param int $id
     * @return void
     */
    function putRol(array $rol, int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function delRol(int $id);

    /**
     * @param int $id
     * @return boolean
     */
    function restoreRol(int $id);
}

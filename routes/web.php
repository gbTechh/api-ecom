<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => "/v1"], function () use ($router) {
    $router->group(['prefix' => '/rol', 'middleware' => ['auth', 'admin']], function () use ($router) {
        $router->post('/create', 'RolController@createRol');
        $router->get('/listwhitdelete', 'RolController@getListRol');
        $router->get('/listonlydelete', 'RolController@getListRolOnlyDelete');
        $router->get('/list', 'RolController@getListRolNoDelete');
        $router->put('/{id}', 'RolController@putRol');
        $router->delete('/{id}', 'RolController@deleteRol');
        $router->get('/{id}/restore', 'RolController@restoreRol');
    });

    $router->group(['prefix' => '/module', 'middleware' => ['auth', 'admin']], function () use ($router) {
        $router->post('/create', 'ModuleController@createModule');
        $router->get('/listwhitdelete', 'ModuleController@getListModule');
        $router->get('/listonlydelete', 'ModuleController@getListModuleOnlyDelete');
        $router->get('/list', 'ModuleController@getListModuleNoDelete');
        $router->put('/{id}', 'ModuleController@putModule');
        $router->delete('/{id}', 'ModuleController@deleteModule');
        $router->get('/{id}/restore', 'ModuleController@restoreModule');
    });
    $router->group(['prefix' => '/permission', 'middleware' => ['auth', 'admin']], function () use ($router) {
        $router->post('/create', 'PermissionController@createPermission');
        $router->get('/listwhitdelete', 'PermissionController@getListPermission');
        $router->get('/listonlydelete', 'PermissionController@getListPermissionOnlyDelete');
        $router->get('/list', 'PermissionController@getListPermissionNoDelete');
        $router->put('/{id}', 'PermissionController@putPermission');
        $router->delete('/{id}', 'PermissionController@deletePermission');
        $router->get('/{id}/restore', 'PermissionController@restorePermission');
    });

    $router->group(['prefix' => '/admin'], function () use ($router) {
        $router->post('/login', 'AuthController@login');
        $router->post('/register', ['middleware' => ['auth', 'admin'], 'uses' => 'AuthController@registerAdmin']);
        $router->post('/logout', ['middleware' => ['auth'], 'uses' => 'AuthController@logout']);
    });

    $router->group(['prefix' => '/customer'], function () use ($router) {
        $router->group(['prefix' => "/auth"], function () use ($router) {
            $router->post('/login', 'AuthController@login');
            $router->post('/register', 'AuthController@registerCustomer');
            $router->post('/logout', ['middleware' => ['auth'], 'uses' => 'AuthController@logout']);
        });
    });
});

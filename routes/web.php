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
    $router->group(['prefix' => "/rol"], function () use ($router) {
        $router->post('/create', 'RolController@createRol');
        $router->get('/listwhitdelete', 'RolController@getListRol');
        $router->get('/listonlydelete', 'RolController@getListRolOnlyDelete');
        $router->get('/list', 'RolController@getListRolNoDelete');
        $router->put('/{id}', 'RolController@putRol');
        $router->delete('/{id}', 'RolController@deleteRol');
        $router->get('/{id}/restore', 'RolController@restoreRol');
    });
});
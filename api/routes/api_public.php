<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Public Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'usuarios'], function () use ($router) {
    $router->get('/', 'UsuarioController@paging');
    $router->get('{id}', 'UsuarioController@getById');
    $router->post('/', 'UsuarioController@create');
    $router->put('{id}', 'UsuarioController@updateById');
    $router->delete('{id}', 'UsuarioController@deleteById');
});

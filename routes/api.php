<?php

use Illuminate\Routing\Router;

/** @var  \Illuminate\Routing\Router $router */

$router->post('login', [
    'as' => 'auth.login',
    'uses' => 'Api\AuthController@login',
]);

$router->get('/', [
    'as' => 'courses',
    'uses' => 'Api\IndexController@index'
]);

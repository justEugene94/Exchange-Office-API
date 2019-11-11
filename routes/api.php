<?php

use Illuminate\Routing\Router;

/** @var  \Illuminate\Routing\Router $router */

$router->post('login', [
    'as' => 'auth.login',
    'uses' => 'Api\AuthController@login',
]);

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

<?php

use Illuminate\Routing\Router;

/** @var  \Illuminate\Routing\Router $router */

$router->post('login', [
    'as'   => 'auth.login',
    'uses' => 'Api\AuthController@login',
]);

$router->get('/', [
    'as'   => 'courses',
    'uses' => 'Api\IndexController@index',
]);

$router->get('currencies', [
    'as' => 'currencies',
    'uses' => 'Api\CurrenciesController@index',
]);

$router->post('purchases', [
    'as'   => 'purchases.store',
    'uses' => 'Api\PurchasesController@store',
]);

$router->group(['middleware' => [
        'auth:api',
    ]], function (Router $router) {
            $router->apiResource('coefficients', 'Api\CoefficientsController');

            $router->get('purchases', [
                'as'   => 'purchases',
                'uses' => 'Api\PurchasesController@index',
            ]);

            $router->get('purchases/{id}', [
                'as'   => 'purchases',
                'uses' => 'Api\PurchasesController@show',
            ]);
});

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze.
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers',], function ($api) {

    $api->post('/auth', 'AuthController@login');

    $api->group(['prefix' => 'user', 'middleware' => 'jwt.auth'], function ($api) {
        $api->get('/', 'UserController@getUser');
        $api->get('/products', 'UserController@getUserProducts');
        $api->post('/products', 'UserController@addUserProducts');
        $api->delete('/products/{SKU}', 'UserController@removeUserProduct');
    });

    $api->get('/products', 'ProductController@getAllProducts');

});

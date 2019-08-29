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

$api->version('v1', [
    'namespace' => 'App\Http\Controllers',
], function ($api) {
    $api->post('/auth', 'AuthController@login');
    $api->get('/me', 'UserController@getUser');

    $api->group(['prefix' => 'user', 'middleware' => 'api.auth'], function ($api) {

        $api->get('/products', 'ProductController@getProducts');
        $api->post('/products', 'ProductController@addProducts');
        $api->delete('/products/{SKU}', 'ProductController@removeProduct');
    });

    $api->get('/products', 'ProductController@getAllProducts');

});

<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// PUBLIC ROUTE: This is where you get your JWT token
$router->post('/login', 'AuthController@login');

// Everything inside this group requires a valid JWT
$router->group(['middleware' => 'auth'], function () use ($router) {

    // User Gateway Routes
    $router->get('/users', 'UserGatewayController@index');
    $router->post('/users', 'UserGatewayController@store');
    $router->get('/users/{id}', 'UserGatewayController@show');
    $router->put('/users/{id}', 'UserGatewayController@update');
    $router->delete('/users/{id}', 'UserGatewayController@delete');

    // Product Gateway Routes
    $router->get('/products', 'ProductGatewayController@index');
    $router->post('/products', 'ProductGatewayController@store');
    $router->get('/products/{id}', 'ProductGatewayController@show');
    $router->put('/products/{id}', 'ProductGatewayController@update');
    $router->delete('/products/{id}', 'ProductGatewayController@delete');
    
});
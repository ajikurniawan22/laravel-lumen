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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
//CRUD City
$router->post('/city/insert', 'CityController@storeCity');
$router->get('/city/get_detail/{id}', 'CityController@getDetailCity');
$router->post('/city/update/{id}', 'CityController@editCity');
$router->delete('/city/delete/{id}', 'CityController@destroyCity');

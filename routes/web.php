<?php

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

$router->get('/', [
   'as' => 'index', 'uses' => 'WelcomeController@index'
]);

$router->group(['prefix' => 'api/v1'], function () use ($router) {
   $router->group(['prefix' => 'auth'], function () use ($router) {


      $router->post('login', 'Users\AuthController@login');

   });
});

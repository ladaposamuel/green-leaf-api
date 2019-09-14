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

   /**
    * Articles
    */
   $router->group(['prefix' => 'articles'], function () use ($router) {
      /**
       * Protected Articles routes
       */
      $router->group(['middleware' => 'auth:api'], function () use ($router) {
         $router->post('/', 'Users\ArticleController@new');
         $router->patch('/{id}', 'Users\ArticleController@update');
         $router->delete('/{id}', 'Users\ArticleController@delete');
      });

      /**
       * Non protected Articles routes
       */
      $router->get('/', 'Users\ArticleController@list');
      $router->get('/{id}', 'Users\ArticleController@view');
      $router->get('/search/{q}', 'Users\ArticleController@search');
   });

   /**
    * Authentication routes
    */
   $router->group(['prefix' => 'auth'], function () use ($router) {
      $router->post('login', 'Users\AuthController@login');
      $router->post('register', 'Users\AuthController@register');
   });
});

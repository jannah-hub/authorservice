<?php
/** @var \Laravel\Lumen\Routing\Router $router */
/*
|---------------------------------------------------------------------
-----
| Application Routes
|---------------------------------------------------------------------
-----
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () use ($router) {
 return $router->app->version();
}); //this will point to your local directory

// unsecure routes 
$router->group(['prefix' => 'api'], function () use ($router) {
 $router->get('/authors',['uses' => 'AuthorController@getAuthors']);
});

 // more simple routes
 $router->get('/authors', 'AuthorController@index'); //get all authors record
 $router->post('/authors', 'AuthorController@add'); //create new authors record
 $router->get('/authors/{id}', 'AuthorController@show'); //get new authors by id record
 $router->put('/authors/{id}', 'AuthorController@update'); //update author record
 $router->patch('/authors/{id}', 'AuthorController@update'); //update author record
 $router->delete('/authors/{id}', 'AuthorController@delete'); //delete record

?>
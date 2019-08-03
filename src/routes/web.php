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

$router->get('/', 'HomeController@index');
$router->get('/get-list', 'HomeController@getList');
$router->get('/containers', 'HomeController@containers');
$router->get('/containers/generate', 'HomeController@getContainersGenerate');
$router->post('/containers/generate', 'HomeController@postContainersGenerate');
$router->get('/info', 'HomeController@info');

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

$app->get('/', function () use ($app) {
    return "Politikei api";
});

$app->group(['prefix'=>'user'], function () use($app)
{
    $app->get('/','App\Http\Controllers\UserController@index');
    $app->get('/{id}',',App\Http\Controllers\UserController@show');
    $app->post('new','App\Http\Controllers\UserController@store');
    $app->put('/{id}','App\Http\Controllers\UserController@update');
});

$app->group(['prefix'=>'propositions'], function () use($app)
{
    $app->get('/','App\Http\Controllers\ProposicoesController@index');
    $app->post('vote','App\Http\Controllers\ProposicoesController@vote');

});

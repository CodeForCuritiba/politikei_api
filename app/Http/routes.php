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


$app->group(['prefix'=>'user'], function () use($app)
{
    $app->get('/','App\Http\Controllers\UserController@index');
    $app->get('/{id}','App\Http\Controllers\UserController@show');
    $app->post('new','App\Http\Controllers\UserController@store');
    $app->put('/{id}','App\Http\Controllers\UserController@update');
    $app->delete('/{id}','App\Http\Controllers\UserController@destroy');
});

$app->group(['prefix'=>'parlamentary'],function () use($app)
{
    $app->get('/','App\Http\Controllers\ParlamentarController@index');
    $app->get('/{id}','App\Http\Controllers\ParlamentarController@show');
    $app->post('new','App\Http\Controllers\ParlamentarController@store');
    $app->put('/{id}','App\Http\Controllers\ParlamentarController@update');
    $app->delete('/{id}','App\Http\Controllers\ParlamentarController@destroy');
});

$app->group(['prefix'=>'propositions'], function () use($app)
{
    $app->get('/','App\Http\Controllers\ProposicaoController@index');

    $app->get('/{id}','App\Http\Controllers\ProposicaoController@show');
    $app->post('new','App\Http\Controllers\ProposicaoController@store');
    $app->put('/{id}','App\Http\Controllers\ProposicaoController@update');
    $app->delete('/{id}','App\Http\Controllers\ProposicaoController@destroy');
});

$app->group(['prefix'=>'vote'], function () use($app)
{
    $app->post('/user','App\Http\Controllers\VotoController@votoUser');
    $app->post('/parlamentary','App\Http\Controllers\VotoController@votoParlamentar');
});

$app->get('/', function () use ($app) {
    return "Politikei api";
});

$app->post('/', function () use ($app) {
    return "Politikei api";
});

$app->put('/', function () use ($app) {
    return "Politikei api";
});

$app->delete('/', function () use ($app) {
    return "Politikei api";
});

$app->options('/', function () use ($app) {
    return "Politikei api";
});

$app->patch('/', function () use ($app) {
    return "Politikei api";
});

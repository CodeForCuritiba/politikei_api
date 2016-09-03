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
$app->group(['prefix' => 'auth'], function () use($app)
{
    $app->post('/', 'App\Http\Controllers\AuthController@authenticate');
    $app->post('/register', 'App\Http\Controllers\AuthController@register');
    $app->post('/{provider}', 'App\Http\Controllers\AuthController@oAuth');
});

//TODO: Tentar incluir todas as rotas protegistas em um grupo

$app->group(['prefix'=>'user','middleware' => 'jwt.auth'], function () use($app)
{
    $app->get('/me','App\Http\Controllers\UserController@me');
});

$app->group(['prefix'=>'parlamentary', 'middleware' => 'jwt.auth'], function () use($app)
{
    $app->get('/','App\Http\Controllers\ParlamentarController@index');
    $app->get('/{id}','App\Http\Controllers\ParlamentarController@show');
});

$app->group(['prefix'=>'propositions', 'middleware' => 'jwt.auth'], function () use($app)
{
    $app->get('/','App\Http\Controllers\ProposicaoController@index');
    $app->get('/{id}','App\Http\Controllers\ProposicaoController@show');
});

$app->group(['prefix'=>'vote', 'middleware' => 'jwt.auth'], function () use($app)
{
    $app->post('/user','App\Http\Controllers\VotoController@votoUser');
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

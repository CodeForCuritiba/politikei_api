<?php

Route::get('/', function () {
    echo 'Politikei API';
});

Route::group(['prefix' => 'api/v1/'], function () {
    Route::post('auth', ['as' => 'api_auth', 'uses' => 'AuthController@authenticate']);

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('authenticate/user', 'AuthController@getAuthenticatedUser');
        Route::get('users', 'UsersController@getIndex');
        Route::get('proposicoes', 'ProposicoesController@index');
    });
});

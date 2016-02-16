<?php

Route::get('/', function () {
    echo 'Politikei API';
});

Route::group(['prefix' => 'api/v1/'], function () {
	Route::group(['as' => 'api_auth'], function () {
		Route::post('auth', ['uses' => 'AuthController@authenticate']);
	    Route::post('auth/{provider}', ['uses' => 'AuthController@oAuth']);
	});	
    

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('authenticate/user', 'AuthController@getAuthenticatedUser');
        Route::get('users', 'UsersController@getIndex');
        Route::get('proposicoes/{user_id}', 'ProposicoesController@index');
        Route::post('proposicoes/votar/{id}', 'ProposicoesController@votar');
    });
});

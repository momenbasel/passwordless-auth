<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/login/magic', 'Auth\MagicLoginController@show');

Route::post('/login/magic', 'Auth\MagicLoginController@sendToken');

Route::get('/login/magic/{token}', 'Auth\MagicLoginController@ValidateToken');
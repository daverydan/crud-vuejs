<?php

Route::get('/', 'UserController@index');

// API
Route::get('/api/users', ['middleware' => 'log', function () {
	return App\User::all();
}]);

Route::post('/api/users', ['middleware' => 'log', function () {
	return App\User::create(Request::all());
}]);

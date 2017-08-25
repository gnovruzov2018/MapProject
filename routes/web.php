<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile', 'UserController@index');

Route::get('/findPlaceById/{place_id}', 'PlacesController@getPlaceById');

Route::post('/profileImage', 'UserController@store');

Route::prefix('admin')->group(function () {
    Route::get('/places/index', 'PlacesController@index');
    Route::get('/places/delete/{place_id}', 'PlacesController@destroy');
    Route::get('/places/create', 'PlacesController@create');
    Route::post('/places/store', 'PlacesController@store');

});

Route::prefix('register')->group(function () {
    Route::get('/', function () {
        return view('register');
    });
    Route::get('/confirm/{token}', 'Auth\RegisterController@confirmEmail');
});

Route::get('/login', function () {
    return view('login');
});


Auth::routes();

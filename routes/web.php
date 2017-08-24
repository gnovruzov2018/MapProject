<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile', 'UserController@index');

Route::get('/findPlaceById/{place_id}', 'PlacesController@getPlaceById');

Route::get('/admin_places_index', 'PlacesController@index');

Route::post('/profileImage', 'UserController@store');

Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});

Auth::routes();

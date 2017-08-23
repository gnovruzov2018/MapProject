<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->name('home');


Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/profile', 'UserController@index');

Route::get('/findPlaceById/{place_id}', 'PlacesController@getPlaceById');

Route::post('/profileImage', 'UserController@store');

Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

Auth::routes();

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	// Mail::send('welcome', [], function($m) {
	// 	$m->to('atindermann08@gmail.com', 'Atinder')->subject('Testing!');
	// });
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});

Route::controller('auth', 'Auth\AuthController');
Route::controller('password', 'Auth\PasswordController');

Route::get('/mylibrary', ['as'=>'mylibrary', 'uses'=>'BookController@library']);

Route::resource('books','BookController');
Route::resource('books','BookClubController');
Route::resource('books','AuthorController');
Route::resource('books','CategoryController');
Route::resource('books','LanguageController');
Route::resource('books','BookStatusController');

Route::resource('books','ProfileController');
Route::resource('books','AddressController');
Route::resource('books','AreaController');
Route::resource('books','CityController');
Route::resource('books','StateController');
Route::resource('books','CountryController');

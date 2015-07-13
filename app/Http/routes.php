<?php


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
Route::resource('bookclubs','BookClubController');
Route::resource('authors','AuthorController');
Route::resource('categories','CategoryController');
Route::resource('languages','LanguageController');
Route::resource('bookstatuses','BookStatusController');

Route::resource('profile','ProfileController');
Route::resource('addresses','AddressController');
Route::resource('areas','AreaController');
Route::resource('cities','CityController');
Route::resource('states','StateController');
Route::resource('countries','CountryController');

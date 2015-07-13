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
    // $book = new \App\Book;
    // $book->title = 'My Book';
    // $book->description = 'My Book';
    // $book->author = 'My Book';
    // $book->publisher = 'My Book';
    // $book->category = 'My Book';
    // $book->language = 'My Book';
    // $book->release_date = date('Y-m-d');
    // $book->save();

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

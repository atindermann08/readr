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

Route::get('account/activate/{activationCode}',[ 'as' => 'account.activate', 'uses' => 'Auth\AuthController@activateAccount']);
Route::controller('auth', 'Auth\AuthController');
Route::controller('password', 'Auth\PasswordController');

// Route::get('/mylibrary', ['as'=>'mylibrary', 'uses'=>'BookController@library']);

Route::resource('books','BookController',['except'=>'destroy']);
Route::get('books/addtolibrary/{bookId}',['as' => 'books.addtolibrary', 'uses' => 'BookController@addtolibrary']);

Route::resource('bookclubs','BookClubController',['except'=>'destroy']);
Route::get('bookclubs/join/{bookClubId}',['as' => 'bookclubs.join', 'uses' => 'BookClubController@joinclub']);

Route::resource('authors','AuthorController',['except'=>'destroy']);
Route::resource('publishers','PublisherController',['except'=>'destroy']);
Route::resource('categories','CategoryController',['except'=>'destroy']);
Route::resource('languages','LanguageController',['except'=>'destroy']);
Route::resource('bookstatuses','BookStatusController',['except'=>'destroy']);

// Route::resource('profile','ProfileController',['except'=>'destroy']);
// Route::resource('addresses','AddressController',['except'=>'destroy']);
// Route::resource('areas','AreaController',['except'=>'destroy']);
// Route::resource('cities','CityController',['except'=>'destroy']);
// Route::resource('states','StateController',['except'=>'destroy']);
// Route::resource('countries','CountryController',['except'=>'destroy']);

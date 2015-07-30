<?php


Route::get('/', function () {    return view('welcome');});
Route::get('/home', function () {    return view('welcome');});


Route::get('/api/books', 'BookController@apiBooks');
Route::get('/api/books/q', 'BookController@searchBooks');


Route::get('/notifications',
                    [ 'as' => 'notifications',
                      'uses' => 'UserController@showNotifications']);

Route::get('feedback',[ 'as' => 'feedback.create', 'uses' => 'FeedbackController@create']);
Route::post('feedback',[ 'as' => 'feedback.store', 'uses' => 'FeedbackController@store']);

Route::get('account/activate/{activationCode}',[ 'as' => 'account.activate', 'uses' => 'Auth\AuthController@activateAccount']);
Route::controller('auth', 'Auth\AuthController');
Route::controller('password', 'Auth\PasswordController');

Route::get('/mylibrary', ['as'=>'mylibrary', 'uses'=>'BookController@mylibrary']);

Route::resource('books','BookController',['except'=>'destroy']);
Route::get('books/addtolibrary/{bookId}',['as' => 'books.addtolibrary', 'uses' => 'BookController@addtolibrary']);
Route::get('books/request/{bookId}',['as' => 'books.request', 'uses' => 'BookController@request']);

Route::resource('bookclubs','BookClubController',['except'=>'destroy']);
Route::get('bookclubs/join/{bookClubId}',
              [ 'as' => 'bookclubs.join',
                'uses' => 'BookClubController@joinclub']);
Route::get('bookclubs/{bookClubId}/books/{bookId}',
              [ 'as' => 'bookclubs.books.show',
                'uses' => 'BookClubController@showbook']);
Route::get('bookclubs/{bookClubId}/requestbook/{bookId}',
              [ 'as' => 'bookclubs.books.requestbook',
                'uses' => 'BookClubController@requestbook']);
Route::get('bookclubs/{bookClubId}/addbooks',
              [ 'as' => 'bookclubs.books.add',
                'uses' => 'BookClubController@addBooks']);

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

<?php


Route::get('/', function () {
  // flash('testing');
  return view('welcome');});
Route::get('/home', function () {    return view('welcome');});

Route::get('/test', function () {
   dd(auth()->user()->givenBooks()->where('book_club_id', 5)->detach(2));//->delete();
});

// Route::get('/api/books', 'BookController@apiBooks');
// Route::get('/api/books/q', 'BookController@searchBooks');


Route::get('/notifications',
                    [ 'as' => 'notifications',
                      'uses' => 'UserController@showNotifications']);

Route::get('/notifications/{notificationId}/destroy',
                    [ 'as' => 'notifications.destroy',
                      'uses' => 'NotificationController@destroy']);

Route::get('feedback',[ 'as' => 'feedback.create', 'uses' => 'FeedbackController@create']);
Route::post('feedback',[ 'as' => 'feedback.store', 'uses' => 'FeedbackController@store']);

Route::get('account/activate/{activationCode}',[ 'as' => 'account.activate', 'uses' => 'Auth\AuthController@activateAccount']);
Route::controller('auth', 'Auth\AuthController');
Route::controller('password', 'Auth\PasswordController');

Route::get('/mylibrary', ['as'=>'mylibrary', 'uses'=>'BookController@mylibrary']);

Route::resource('books','BookController',['except'=>'destroy']);
Route::get('books/{bookId}/addtolibrary',['as' => 'books.addtolibrary', 'uses' => 'BookController@addtolibrary']);
Route::get('books/{bookId}/removefromlibrary',['as' => 'books.removefromlibrary', 'uses' => 'BookController@removefromlibrary']);
// Route::get('books/request/{bookId}',['as' => 'books.request', 'uses' => 'BookController@request']);

Route::resource('bookclubs','BookClubController',['except'=>'destroy']);
Route::get('bookclubs/join/{bookClubId}',
              [ 'as' => 'bookclubs.join',
                'uses' => 'BookClubController@joinclub']);
Route::get('bookclubs/requests/{requestId}/accept',
              [ 'as' => 'bookclubs.requests.accept',
                'uses' => 'BookClubController@acceptJoinRequest']);
Route::get('bookclubs/requests/{requestId}/reject',
              [ 'as' => 'bookclubs.requests.reject',
                'uses' => 'BookClubController@rejectJoinRequest']);

Route::get('bookclubs/requests/{requestId}/cancel',
                [ 'as' => 'bookclubs.requests.cancel',
                'uses' => 'BookClubController@rejectJoinRequest']);


Route::get('bookclubs/books/requests/{requestId}/accept',
                [ 'as' => 'bookclubs.books.requests.accept',
                'uses' => 'BookClubController@acceptBookRequest']);
Route::get('bookclubs/books/requests/{requestId}/reject',
                [ 'as' => 'bookclubs.books.requests.reject',
                'uses' => 'BookClubController@rejectBookRequest']);
Route::get('bookclubs/books/requests/{requestId}/cancel',
                [ 'as' => 'bookclubs.books.requests.cancel',
                'uses' => 'BookClubController@rejectBookRequest']);

Route::get('bookclubs/{bookClubId}/books/{bookId}',
              [ 'as' => 'bookclubs.books.show',
                'uses' => 'BookClubController@showBook']);

Route::get('bookclubs/{bookClubId}/book/{bookId}/user/{userId}/request',
              [ 'as' => 'bookclubs.books.requestbook',
                'uses' => 'BookClubController@requestbook']);

Route::get('bookclubs/{bookClubId}/addbooks',
              [ 'as' => 'bookclubs.books.add',
                'uses' => 'BookClubController@addBooks']);

Route::post('bookclubs/{bookClubId}/books/add',
                [ 'as' => 'bookclubs.books.store',
                'uses' => 'BookClubController@storeBook']);

Route::get('bookclubs/{bookClubId}/books/{bookId}/remove',
                [ 'as' => 'bookclubs.books.remove',
                'uses' => 'BookClubController@removeBook']);

Route::put('bookclubs/{bookClubId}/books/{bookId}/status/update',
                [ 'as' => 'bookclubs.books.status.update',
                'uses' => 'BookClubController@bookStatusUpdate']);

Route::get('bookclubs/{bookClubId}/books/{bookId}/users/{ownerId}/received',
                [ 'as' => 'bookclubs.books.received',
                'uses' => 'BookClubController@bookReceived']);

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

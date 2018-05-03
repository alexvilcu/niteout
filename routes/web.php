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

Route::get('/map', 'FrontEndController@map');
Route::get('/', 'FrontEndController@index')->name('index');
Route::get('/location/comment/{id}', 'LocationController@create_comment')->name('comment.create');
Route::post('/comments/store', 'LocationController@store_comment')->name('comment.store');
Route::get('/user-profile/{identifier}', 'UserController@view_profile')->name('view.profile');
Route::get('/user-locations', 'UserController@user_locations')->name('user.locations');
Route::post('/location/rate/{identifier}', 'LocationController@rate_location')->name('location.rating');
Route::post('/hangout/invite', 'HangoutController@invite')->name('hangout.invite');
Route::get('/notifications', 'NotificationController@view_notifications')->name('notifications.view');
Route::post('/hangout/accept/{id}', 'HangoutController@accept_hangout_invite')->name('hangout.accept');
Route::get('/notification/{id}', 'NotificationController@delete')->name('notification.mark');



Route::resources([

	'users' => 'UserController',
	'locations'  => 'LocationController',
	'moods' => 'MoodController',
	'tags' => 'TagController',
	'comments' => 'CommentController',
	'hangout' => 'HangoutController'

]);



Auth::routes();
Route::any('/search', 'SearchController@filter')->name('locations.search');
// Route::get('/home', 'HomeController@index')->name('home');

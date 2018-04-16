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



Route::resources([

	'users' => 'UserController',
	'locations'  => 'LocationController',
	'moods' => 'MoodController',
	'tags' => 'TagController',
	'comments' => 'CommentController'

]);



Auth::routes();
Route::any('/search', 'SearchController@filter')->name('locations.search');
// Route::get('/home', 'HomeController@index')->name('home');

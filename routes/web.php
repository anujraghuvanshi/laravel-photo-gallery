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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'AlbumsController@index');
Route::get('/albums', 'AlbumsController@index');
Route::get('/albums/create', 'AlbumsController@create');
Route::post('/albums/store', 'AlbumsController@store');
Route::get('/albums/show/{id}', 'AlbumsController@show');

Route::get('/photos/create/{id}', 'PhotosController@create');
Route::post('/photos/store', 'PhotosController@store');


Route::get('/photos/{id}', 'PhotosController@show');
Route::delete('/photos/{id}', 'PhotosController@destroy');



Route::group(['prefix' => 'api/v1'], function(){
	//login user 
	Route::post('/login', 'Api\AuthController@login');

	Route::group(['prefix' => 'user'], function(){

		Route::post('/register','Api\UsersController@store');
		
		Route::get('/', 'Api\UsersController@index');

		Route::post('/login', 'Api\UsersController@login');

		Route::get('/{id}', 'Api\UsersController@userById');

		Route::post('/update/{id}', 'Api\UsersController@userUpdate');

		Route::delete('/delete/{id}', 'Api\UsersController@distroy');

	});
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




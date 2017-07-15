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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'v1'], function(){
	//login user 
	Route::post('/login', 'Api\AuthController@login');

	Route::group(['prefix' => 'user'], function(){

		Route::post('/','Api\UsersController@store');
		
		Route::get('/', 'Api\UsersController@index');

		Route::get('/{id}', 'Api\UsersController@userById');

		Route::post('/update/{id}', 'Api\UsersController@userUpdate');

		Route::delete('/delete/{id}', 'Api\UsersController@distroy');

	});
});
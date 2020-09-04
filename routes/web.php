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
	if (Auth::check())
		return redirect()->route('home');
	else
		return redirect()->route('login');
});

Auth::routes();

// Controller Route Home
Route::get('/home', 'HomeController@index')->name('home');

// Paths to update and delete fields from datatables
Route::post('updateTable', 'AjaxTableController@update');
Route::post('deleteTable', 'AjaxTableController@destroy');

// Path to fill in the datatable of registered users
Route::get('users', 'UserController@show')->name('users');

// New user registration
Route::post('newUser', 'UserController@store');

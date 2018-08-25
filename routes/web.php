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


/**
 * Processes routes
 */
Route::get('process/categories', 'ProcessController@categories');
Route::get('process/items', 'ProcessController@items');

/**
 * Actions routes
 */
Route::get('action/{action}/{params}', 'ActionController@action');


/**
 * Auth outes
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



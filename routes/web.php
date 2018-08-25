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

Route::get('/search', 'DevController@search');

Route::get('/search-img', 'DevController@imageSearch');

Route::get('/mongo', 'DevController@mongo');

Route::get('/embed', 'DevController@embed');



Route::get('/categories', 'DevController@categories');
Route::get('/items', 'DevController@items');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



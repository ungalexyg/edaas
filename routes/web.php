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

Route::get('/info', function () {
    echo phpinfo(); die;

    return view('welcome');
});


Route::get('/mongo', 'DevController@mongo');

Route::get('/collect', 'DevController@collect');

Route::get('/images', 'DevController@gimages');

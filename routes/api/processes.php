<?php

/**
 * Process Routes
 */

Route::group(['prefix' => 'processes',], function(){
    Route::get('/categories'    , 'ProcessController@categories');        
    Route::get('/items'         , 'ProcessController@items');        
}); 

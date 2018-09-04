<?php

/**
 * Processes Routes
 */
Route::group(['namespace' => 'Process', 'prefix' => 'process',], function(){
    Route::post('/categories'    , 'ProcessController@categories');        
    Route::post('/items'         , 'ProcessController@items');        
}); 

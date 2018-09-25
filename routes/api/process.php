<?php

/**
 * Processes Routes
 */
Route::group(['namespace' => 'Process', 'prefix' => 'process',], function(){
    Route::post('/categories'    , 'ProcessController@categories');        
    

    Route::any('/items'         , 'ProcessController@items');//TODO: any >> POST        

}); 

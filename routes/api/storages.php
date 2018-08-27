<?php

use Illuminate\Http\Request;


/**
 * Storages Routes
 */

Route::group(['prefix' => 'storages',], function(){

    /**
     * Storage Category Routes
     */
    Route::group(['prefix' => 'categories',], function(){
        Route::get('/', 'StorageCategoryController@index');        
        Route::get('/{id}/activate', 'StorageCategoryController@activate');        
    }); 


    /**
     * Storage Item Routes
     */    
    Route::group(['prefix' => 'items',], function(){
        Route::get('/{id}', 'StorageItemController@index');   
    });    
}); 



 
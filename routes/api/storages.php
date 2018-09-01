<?php

/**
 * Storages Routes
 */

Route::group(['prefix' => 'storages',], function(){

    /**
     * Storage Category Routes
     */
    //Route::resource('categories', 'StorageCategoryController');                
    Route::group(['prefix' => 'categories',], function() {

        Route::any('/activate'          , 'StorageCategoryController@activateAll');    
        Route::any('/{id}/activate'     , 'StorageCategoryController@activate');        
        
        Route::any('/deactivate'        , 'StorageCategoryController@deactivateAll');        
        Route::any('/{id}/deactivate'   , 'StorageCategoryController@deactivate');        
        
        Route::any('/publish'           , 'StorageCategoryController@publishAll');        
        Route::any('/{id}/publish'      , 'StorageCategoryController@publish');
        
        Route::any('/unpublish'         , 'StorageCategoryController@unpublishAll');        
        Route::any('/{id}/unpublish'    , 'StorageCategoryController@unpublish');        
    }); 


    /**
     * Storage Item Routes
     */    
    Route::group(['prefix' => 'items',], function(){
       // Route::get('/{id}', 'StorageItemController@index');   
    });    
}); 



 
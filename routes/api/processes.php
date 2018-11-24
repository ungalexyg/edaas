<?php

/**
 * Processes Routes
 */
Route::group([
        'namespace' => 'Processes', 
        'prefix'    => 'processes'
    ], function() {

        // e.g: 
        // /api/processes/channels/aliexpress/categories
        Route::any('/channels/{channel}/{process}' ,'ProcessesController@channels'); //TODO: change to POST        
}); 

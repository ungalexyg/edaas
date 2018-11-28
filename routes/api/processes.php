<?php

/**
 * Processes Routes
 */
Route::group([
        'namespace' => 'Processes'
    ], function() {
        
    Route::any('/processes/{process}' ,'ProcessesController@channels'); //TODO: change to POST        
}); 

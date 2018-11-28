<?php

/**
 * Processes Routes
 */
Route::group([
        'namespace' => 'Processes'
    ], function() {
        
    Route::any('/processes/{process}' ,'ProcessesController@process'); //TODO: change to POST        
}); 

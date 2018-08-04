<?php

namespace App\Exceptions;

use Exception;


/**
 * Process Exception
 * Handle exceptions generated in App\Processes\Base
 */
class ProcessException extends Exception
{

    const PROCESS_UNDEFINED             = 'Trying to set undefined process';
    const PROCESS_SCANNER_UNDEFINED     = 'Can\'t set process with undefined scanner';
    const PROCESS_KEEPER_UNDEFINED      = 'Can\'t set process with undefined keeper';
    const PROCESS_WATCHER_UNDEFINED     = 'Can\'t set process with undefined watcher';


    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        // log / email / etc ...
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    // public function render($request)
    // {
            // implement custom output, IF needed
    // }
}




<?php

namespace App\Exceptions;

use Exception;


/**
 * Process Exception
 * Handle exceptions generated in App\Processes\Base
 */
class ProcessorException extends Exception
{

    const PROCESS_UNDEFINED             = 'Trying to set undefined process';
    const PROCESS_UNDEFINED_SCANNER     = 'Can\'t set process with undefined scanner';
    const PROCESS_UNDEFINED_KEEPER      = 'Can\'t set process with undefined keeper';
    const PROCESS_UNDEFINED_WATCHER     = 'Can\'t set process with undefined watcher';
    const PROCESS_UNDEFINED_START       = 'Undefined process starter';
    const PROCESS_UNDEFINED_STOP        = 'Undefined process stopper';

    
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




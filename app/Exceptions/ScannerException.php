<?php

namespace App\Exceptions;

use Exception;


/**
 * Scanner Exception
 * Handle exceptions generated in App\Processes\Scanners
 */
class ScannerException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
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

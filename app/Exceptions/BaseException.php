<?php

namespace App\Exceptions;

use Exception as CoreException;


/**
 * Base Exception
 * Handle common exceptions functionality
 */
class BaseException extends CoreException
{
    
    const METHOD_NOT_IMPLEMENTED = 'Method not implemented';


    // /**
    //  * Report the exception.
    //  *
    //  * @return void
    //  */
    // public function report()
    // {
    //     // log / email / etc ...
    // }

    // /**
    //  * Render the exception into an HTTP response.
    //  *
    //  * @param  \Illuminate\Http\Request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function render($request)
    // {
    //         implement custom output, IF needed
    // } 
}

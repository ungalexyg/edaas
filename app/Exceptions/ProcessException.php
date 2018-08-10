<?php

namespace App\Exceptions;

use Exception;


/**
 * Process Exception
 */
class ProcessorException extends BaseException
{
    const PROCESSOR_PROCESS_UNDEFINED   = 'Trying to set undefined process';
    const PROCESSOR_CHANNEL_UNDEFINED   = 'Trying to set undefined channel';
    const PROCESSOR_SCANNER_UNDEFINED   = 'Can\'t set process with undefined scanner';
    const PROCESSOR_KEEPER_UNDEFINED    = 'Can\'t set process with undefined keeper';
    const PROCESSOR_WATCHER_UNDEFINED   = 'Can\'t set process with undefined watcher';  
}




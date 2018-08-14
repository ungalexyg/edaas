<?php

namespace App\Exceptions;

use Exception;


/**
 * Process Exception
 */
class ProcessorException extends BaseException
{
    const PROCESSOR_UNDEFINED           = 'Trying to load undefined processor';
    const PROCESSOR_SCANNER_UNDEFINED   = 'Trying to load undefined scanner';
    const PROCESSOR_KEEPER_UNDEFINED    = 'Trying to load undefined keeper';
    const PROCESSOR_WATCHER_UNDEFINED   = 'Trying to load undefined watcher';  
    const PROCESSOR_PROCESS_UNDEFINED   = 'Trying to set undefined process';
    const PROCESSOR_CHANNEL_UNDEFINED   = 'Trying to set undefined channel';
}




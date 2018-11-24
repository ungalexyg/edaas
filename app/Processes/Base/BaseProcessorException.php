<?php

namespace App\Processes\Base;

use App\Exceptions\ProcessorException;


/**
 * Base Processor Exception
 */
class BaseProcessorException extends ProcessorException
{
    const UNDEFINED_PROCESSOR   = 'Failed to load undefined processor instance';
    const INVALID_PROCESSOR     = 'Trying to load invalid processor instance';
}




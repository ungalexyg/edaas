<?php

namespace App\Exceptions\Processors;

use App\Exceptions\BaseException;


/**
 * Process Exception
 */
class MainProcessorException extends BaseException
{
    const UNDEFINED_PROCESSOR   = 'Failed to load undefined processor instance';
    const INVALID_PROCESSOR     = 'Trying to load invalid processor instance';
}




<?php

namespace App\Exceptions\Processors;

use App\Exceptions\BaseException;


/**
 * Process Exception
 */
class BaseProcessorException extends BaseException
{
    const MATURE_CHANNELS_NOT_FOUND     = 'Mature channels not found';
    const UNDEFINED_PROCESS             = 'Trying to set undefined process';
    const UNDEFINED_ADAPTER             = 'Trying to load undefined adapter';
}




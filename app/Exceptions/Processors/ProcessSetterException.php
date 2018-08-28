<?php

namespace App\Exceptions\Processors;

use App\Exceptions\BaseException;


/**
 * Process Exception
 */
class MainProcessorException extends BaseException
{
    const UNDEFINED_PROCESS             = 'Can\'t set undefined process key';
    const MATURE_CHANNELS_NOT_FOUND     = 'Mature channels for the process not found yet, try after the maturity period that was set in the config under the min_age';
}




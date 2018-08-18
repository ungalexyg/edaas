<?php

namespace App\Exceptions\Processors;

use Exception;
use App\Exceptions\BaseException;


/**
 * Process Exception
 */
class ProcessException extends BaseException
{
    const UNDEFINED_PROCESS             = 'Can\'t set undefined process key';
    const UNDEFINED_CHANNEL             = 'Can\'t set undefined channel key';
    const UNDEFINED_PROCESSOR           = 'Failed to load undefined processor instance';
    const UNDEFINED_SCANNER             = 'Failed to load undefined scanner instance';
    const UNDEFINED_KEEPER              = 'Failed to load undefined keeper instance';
    const UNDEFINED_WATCHER             = 'Failed to load undefined watcher instance';  
    const UNDEFINED_ADAPTER             = 'Failed to load undefined adapter instance';  
    const FAILED_PULL_INVALID_INSTANCE  = 'Trying to pull process data from invalid processor instance';
    const FAILED_PUSH_INVALID_INSTANCE  = 'Trying to push process data to invalid processor instance';
    const FAILED_PULL_INVALID_PROPERTY  = 'Trying to pull process data from invalid processor property';
    const FAILED_PUSH_INVALID_PROPERTY  = 'Trying to push process data from invalid property on the pushing instance';
}




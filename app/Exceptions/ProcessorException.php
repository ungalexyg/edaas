<?php

namespace App\Exceptions;

/**
 * Processor Exception
 */
class ProcessorException extends BaseException
{
    const UNDEFINED_PROCESS             = 'Trying to set undefined process';
    const UNDEFINED_PROCESSOR           = 'Failed to load undefined processor instance';
    const INVALID_INSTANCE_PROCESSOR    = 'Trying to load invalid processor instance';
    const INVALID_INSTANCE_PROCESS      = 'Trying to load invalid process instance';
    const INVALID_INSTANCE_PROCESSABLE  = 'Trying to load invalid process instance';
    const INVALID_BAG_CONTENTS          = 'Invalid bag contents passed to processor';  
}




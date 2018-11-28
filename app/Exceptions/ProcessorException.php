<?php

namespace App\Exceptions;

/**
 * Processor Exception
 */
class ProcessorException extends BaseException
{
    const UNDEFINED_PROCESS     = 'Trying to set undefined process';
    const UNDEFINED_PROCESSOR   = 'Failed to load undefined processor instance';
    const INVALID_PROCESSOR     = 'Trying to load invalid processor instance';
    const INVALID_BAG_CONTENTS  = 'Invalid bag contents passed to processor';  
}




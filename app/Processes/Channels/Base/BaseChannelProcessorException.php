<?php

namespace App\Processes\Channels\Base;

use App\Exceptions\ProcessorException;


/**
 * Channels Processor Exception
 */
class BaseChannelProcessorException extends ProcessorException
{
    const UNDEFINED_PROCESS                     = 'Trying to set undefined process';
    const UNDEFINED_ADAPTER                     = 'Trying to load undefined adapter';
    const INVALID_BAG_CONTENTS                  = 'Invalid bag contents passed to processor';
    const MATURE_CHANNELS_NOT_FOUND             = 'Mature channels not found';
    const MATURE_STORAGE_CATEGORIES_NOT_FOUND   = 'Mature storage categories not found';    
}

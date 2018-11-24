<?php

namespace App\Processes\Channels\Aliexpress\Exceptions;

use App\Exceptions\ProcessorException;


/**
 * Processor Exception
 */
class AliexpressCategoriesProcessorException extends ProcessorException
{
    const INVALID_STORAGE_CATEORY_INSTANCE  = 'Can\'t parse items, invlaid storage category instance given';
}

<?php

namespace App\Models\Collectors\Base;

use App\Exceptions\ModelException;


/**
 * Base Collector Exception
 */
class BaseCollectorException extends ModelException
{
    const INVALID_PROCESS_CONFIG  = 'Failed to get mature collections, invalid config.';    
}

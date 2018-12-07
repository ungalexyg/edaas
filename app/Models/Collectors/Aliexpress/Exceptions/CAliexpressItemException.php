<?php

namespace App\Models\Collectors\Aliexpress\Exceptions;

use App\Exceptions\ModelException;


/**
 * Model Exception
 */
class CAliexpressItemException extends ModelException
{
    const INVALID_CHANNEL_ITEM_ID     = 'Store failed, got record with invalid channel item id';    
}

<?php

namespace App\Exceptions\Models;

use App\Exceptions\ModelException;

/**
 * Storage Item Exception
 */
class StorageItemException extends ModelException
{
    const STORE_INVALID_CHANNEL_KEY             = 'Store failed, got invalid channel key ';
    const STORE_INVALID_CHANNEL_ITEM_ID         = 'Store failed, got record with invalid channel item id';    
}

<?php

namespace App\Exceptions\Models;

use App\Exceptions\ModelException;

/**
 * Storage Category Exception
 */
class StorageCategoryException extends ModelException
{
    const STORE_INVALID_CHANNEL_KEY             = 'Store failed, got invalid channel key ';
    const STORE_INVALID_CHANNEL_CATEGORY_ID     = 'Store failed, got record with invalid channel category id';    
}

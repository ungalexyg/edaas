<?php

namespace App\Exceptions\Models;


/**
 * Storage Category Exception
 */
class StorageCategoryException extends BaseModelException
{
    const STORE_INVALID_CHANNEL_KEY             = 'Store failed, got invalid channel key ';
    const STORE_INVALID_CHANNEL_CATEGORY_ID     = 'Store failed, got record with invalid channel category id';    
}

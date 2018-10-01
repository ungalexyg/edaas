<?php

namespace App\Exceptions\Adapters\Aliexpress;

use App\Exceptions\BaseException;


/**
 * Adpter Exception
 */
class AliexpressItemsAdapterException extends BaseException
{
    const INVALID_ITEM_URL      = 'Failed to parse to item url, invalid url stracutre.';
    const INVALID_ITEM_URL_SLUG = 'Failed to parse to item url, invalid slug.';
    const INVALID_ITEM_URL_ID   = 'Failed to parse to item url, invalid item id.';
}

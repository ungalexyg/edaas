<?php

namespace App\Processes\Channels\Aliexpress\Exceptions;

use App\Exceptions\AdapterException;


/**
 * Adpter Exception
 */
class AliexpressCategoriesAdapterException extends AdapterException
{
    const INVALID_ITEM_URL              = 'Failed to parse to item url, invalid url stracutre.';
    const INVALID_ITEM_URL_SLUG         = 'Failed to parse to item url, invalid slug.';
    const INVALID_ITEM_URL_ID           = 'Failed to parse to item url, invalid item id.';
    const FETCHED_INVALID_PRICES_STR    = 'Fetched invalid prices str.';
}

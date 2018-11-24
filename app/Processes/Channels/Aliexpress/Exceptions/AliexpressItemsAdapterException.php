<?php

namespace App\Processes\Channels\Aliexpress\Exceptions;

use App\Exceptions\AdapterException;


/**
 * Adpter Exception
 */
class AliexpressItemsAdapterException extends AdapterException
{
    const INVALID_STORAGE_CATEORY_INSTANCE  = 'Can\'t parse items, invlaid storage category instance given';
}

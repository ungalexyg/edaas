<?php

namespace App\Exceptions\Adapters\Aliexpress;

use App\Exceptions\BaseException;


/**
 * Adpter Exception
 */
class AliexpressCategoriesAdapterException extends BaseException
{
    const INVALID_STORAGE_CATEORY_INSTANCE  = 'Can\'t parse items, invlaid storage category instance given';
}

<?php

namespace App\Models\Collectors\Aliexpress\Exceptions;

use App\Exceptions\ModelException;


/**
 * Storage Category Exception
 */
class CAliexpressCategoryException extends ModelException
{
    const INVALID_CHANNEL_CATEGORY_ID     = 'Store failed, got record with invalid channel category id';    
}

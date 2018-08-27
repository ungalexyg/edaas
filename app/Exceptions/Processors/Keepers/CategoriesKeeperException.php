<?php

namespace App\Exceptions\Processors\Keepers;

use App\Exceptions\BaseException;


/**
 * Categories Keeper Exception
 */
class CategoriesKeeperException extends BaseException
{
    const INVALID_BAG_CONTENTS          = 'Invalid bag contents passed to the keeper';
    const INVALID_CHANNEL_KEY           = 'Invalid channel key passed to keeper';
    const INVALID_CHANNEL_CATEGORY_ID   = 'Invalid channel category id passed to keeper';
}

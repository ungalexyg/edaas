<?php

namespace App\Exceptions\Processors\Keepers;

use Exception;
use App\Exceptions\BaseException;


/**
 * Categories Keeper Exception
 */
class CategoriesKeeperException extends BaseException
{
    
    const INVALID_BAG_CONTENTS = 'Failed progress with process, invalid bag contents passed to the keeper';

}

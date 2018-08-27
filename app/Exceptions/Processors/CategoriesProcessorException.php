<?php

namespace App\Exceptions\Processors;

use App\Exceptions\BaseException;


/**
 * Categories Processor Exception
 */
class CategoriesProcessorException extends BaseException
{
    const INVALID_BAG_CONTENTS          = 'Invalid bag contents passed to the keeper';
    const INVALID_CHANNEL_KEY           = 'Invalid channel key passed to keeper';
    const INVALID_CHANNEL_CATEGORY_ID   = 'Invalid channel category id passed to keeper';
}

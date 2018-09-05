<?php

namespace App\Exceptions\Processors;

use App\Exceptions\BaseException;


/**
 * Categories Processor Exception
 */
class CategoriesProcessorException extends BaseException
{
    const INVALID_BAG_CONTENTS          = 'Invalid bag contents passed to processor';
}

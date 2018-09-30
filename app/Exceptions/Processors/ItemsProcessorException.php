<?php

namespace App\Exceptions\Processors;

use App\Exceptions\BaseException;


/**
 * Items Processor Exception
 */
class ItemsProcessorException extends BaseException
{
    const MATURE_STORAGE_CATEGORIES_NOT_FOUND     = 'Mature storage categories not found';
}

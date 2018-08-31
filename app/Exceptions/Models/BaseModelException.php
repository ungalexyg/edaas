<?php

namespace App\Exceptions\Models;

use App\Exceptions\BaseException;


/**
 * Base Model Exception
 */
class BaseModelException extends BaseException
{
    const INVALID_INPUT     = 'Invalid input';        
    const ENTITY_NOT_FOUND  = 'Entity not found';        
}

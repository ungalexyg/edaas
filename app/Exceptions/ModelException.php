<?php

namespace App\Exceptions;


/**
 * Model Exception
 */
class ModelException extends BaseException
{
    const INVALID_INPUT     = 'Invalid input';        
    const INVALID_ENTITY    = 'Trying to set invalid entity';        
    const INVALID_METHOD    = 'Failed to init instance, invalid method';        
    const ENTITY_NOT_FOUND  = 'Entity not found';    
}

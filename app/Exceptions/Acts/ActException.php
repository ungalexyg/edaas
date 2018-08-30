<?php

namespace App\Exceptions\Acts;

use App\Exceptions\BaseException;


/**
 * Act Exception
 */
class ActException extends BaseException
{
    const INVALID_REFERENCE         = 'Invalid act reference';
    const UNDEFINED_KEY             = 'Undefined act key';
    const UNDEFINED_ACT             = 'Trying to load undefined act class';
    const INVALID_ACT               = 'Loaded invalid act instance';
    const INVALID_MODEL             = 'Act instance trying to set invalid model instance';
    const REQUIRED_PARAMS_MISSING   = 'Required paramters for the act are missing';
}
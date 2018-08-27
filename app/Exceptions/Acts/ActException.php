<?php

namespace App\Exceptions\Acts;

use App\Exceptions\BaseException;


/**
 * Act Exception
 */
class ActException extends BaseException
{
    const UNDEFINED_ACT_KEY         = 'Undefined act key';
    const INVALID_ACT_INSTANCE      = 'Loaded invalid act instance';
    const REQUIRED_PARAMS_MISSING   = 'Required paramters for the act are missing';
}
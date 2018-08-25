<?php

namespace App\Exceptions\Actions;

use Exception;
use App\Exceptions\BaseException;


/**
 * Action Exception
 */
class ActionException extends BaseException
{
    const UNDEFINED_ACTION_KEY      = 'Undefined action key';
    const INVALID_ACTION_INSTANCE   = 'Loaded invalid action instance';
    const REQUIRED_PARAMS_MISSING   = 'Required paramters for the action are missing';
}




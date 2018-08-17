<?php

namespace App\Exceptions;

use Exception;

/**
 * Adpter Exception
 */
class AdapterException extends BaseException
{
    const UNDEFINED_DOMAIN = 'Trying to build URL with undefined domain';
}

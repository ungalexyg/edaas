<?php

namespace App\Exceptions\Adapters\Base;

use Exception;
use App\Exceptions\BaseException;


/**
 * Adpter Exception
 */
class AdapterException extends BaseException
{
    const UNDEFINED_DOMAIN = 'Trying to build URL with undefined domain';
}

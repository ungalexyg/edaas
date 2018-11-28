<?php

namespace App\Exceptions;


/**
 * Adpter Exception
 */
class AdapterException extends BaseException
{
    const UNDEFINED_ADAPTER     = 'Trying to load undefined adapter';
    const UNDEFINED_DOMAIN      = 'Trying to build URL with undefined domain';
}

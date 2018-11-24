<?php

namespace App\Processes\Channels\Base;

use App\Exceptions\AdapterException;


/**
 * Channels Processor Exception
 */
class ChannelsAdapterException extends AdapterException
{
    const UNDEFINED_DOMAIN = 'Trying to build URL with undefined domain';
}

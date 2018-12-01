<?php 

namespace App\Enums;

use App\Enums\ChannelEnum as Channel;


/**
 * Processes Enum
 */ 
class ProcessEnum extends BaseEnum 
{
    /**
     * Channels processes
     */
    const ALIEXPRESS_CATEGORIES    = Channel::ALIEXPRESS . '_categories';
    const ALIEXPRESS_CATEGORY      = Channel::ALIEXPRESS . '_category';
    const SHOPIFY_SITES            = Channel::SHOPIFY . '_sites';
}

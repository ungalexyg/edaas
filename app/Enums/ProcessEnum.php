<?php 

namespace App\Enums;

use App\Enums\ChannelEnum as Channel;


/**
 * Processes Enum
 */ 
class ProcessEnum extends BaseEnum 
{
    #####################################
    # Statuses
    #####################################

    const PAUSED = 0;
    const ACTIVE = 1;
    

    #####################################
    # Channels
    #####################################


    /**
     * Shopify processes
     */
    const SHOPIFY_SITES            = Channel::SHOPIFY . '_sites';
    const SHOPIFY_CATEGORIES       = Channel::SHOPIFY . '_categories';

    /**
     * Aliexpress processes
     */    
    const ALIEXPRESS_CATEGORIES    = Channel::ALIEXPRESS . '_categories';
    const ALIEXPRESS_ITEMS         = Channel::ALIEXPRESS . '_items';
}

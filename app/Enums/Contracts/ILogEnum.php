<?php 

namespace App\Enums\Contracts;

use App\Enums\ProcessableEnum as Processable;


/**
 * Logs Enum Interface
 */ 
interface ILogEnum
{
    /**
     * Log channels
     */
    const MAIN_PROCESSOR            = 'main_processor';
    const ALIEXPRESS_CATEGORIES     = Processable::KEY_ALIEXPRESS_CATEGORIES;
    const ALIEXPRESS_ITEMS          = Processable::KEY_ALIEXPRESS_ITEMS;
    const SHOPIFY_SITES             = Processable::KEY_SHOPIFY_SITES;


    /**
     * Log messages
     */
    const DONE          = 'action completed';    
    const BAG_OK        = 'got full bag'; 
    const BAG_FAILED    = 'failed to get the bag';    
    const EXCEPTION     = 'EXCEPTION!';    
}

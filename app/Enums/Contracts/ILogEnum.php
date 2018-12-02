<?php 

namespace App\Enums\Contracts;

use App\Enums\ProcessEnum as Processes;


/**
 * Logs Enum Interface
 */ 
interface ILogEnum
{
    /**
     * Log channels
     */
    const MAIN_PROCESSOR            = 'main_processor';
    const ALIEXPRESS_CATEGORIES     = Processes::ALIEXPRESS_CATEGORIES;
    const ALIEXPRESS_ITEMS          = Processes::ALIEXPRESS_ITEMS;
    const SHOPIFY_SITES             = Processes::SHOPIFY_SITES;


    /**
     * Log messages
     */
    const DONE          = 'action completed';    
    const BAG_OK        = 'got full bag'; 
    const BAG_FAILED    = 'failed to get the bag';    
    const EXCEPTION     = 'EXCEPTION!';    
}

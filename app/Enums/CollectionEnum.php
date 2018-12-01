<?php 

namespace App\Enums;

use App\Enums\ProcessEnum as Process;


/**
 * Collections records keys
 */ 
class CollectionEnum extends BaseEnum 
{
    /**
     * Collections db tables prefix
     */        
    const PREFIX                    = 'c_'; 


    /**
     * Collections db tables
     */  
    const ALIEXPRESS_CATEGORIES     = self::PREFIX . Process::ALIEXPRESS_CATEGORIES;
    const ALIEXPRESS_ITEMS          = self::PREFIX . Process::ALIEXPRESS_ITEMS;
    const SHOPIFY_SITES             = self::PREFIX . Process::SHOPIFY_SITES;


    /**
     * Processable collection db fields
     */
    const CONTENT_STATUS            = 'content_status';
    const PROCESS_STATUS            = 'process_status';    
    const PROCESS_COUNT             = 'process_count';
    const PROCESS_LAST              = 'process_last';
   

    /**
     * Collection process statuses
     */    
    const PROCESS_PAUSED        = 0;
    const PROCESS_ACTIVE        = 1;    


    /**
     * Collection content statuses
     */        
    const CONTENT_ARCHIVED      = 0; 
    const CONTENT_PUBLISHED     = 1;     
}

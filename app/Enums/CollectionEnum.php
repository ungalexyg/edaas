<?php 

namespace App\Enums;

use App\Enums\DBEnum as DBS;


/**
 * Collections records keys
 */ 
class CollectionEnum extends BaseEnum 
{
    /**
     * Collections db tables prefix
     */        
    const PREFIX                = DBS::PREFIX_COLLECTION;


    /**
     * Processable collection db fields
     */
    const CONTENT_STATUS        = DBS::CONTENT_STATUS;
    const PROCESS_STATUS        = DBS::PROCESS_STATUS;
    const PROCESS_COUNT         = DBS::PROCESS_COUNT;
    const LAST_PROCESS          = DBS::LAST_PROCESS;
   

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

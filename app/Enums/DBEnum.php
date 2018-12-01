<?php 

namespace App\Enums;


/**
 * DB Enum, aggregate common DB keys
 */ 
class DBEnum extends BaseEnum 
{
    /**
     * Collections db tables prefix
     */
    const PREFIX_COLLECTION     = 'c_'; // storage collections prefix    


    /**
     * Processable entities keys
     */    
    const PROCESS_STATUS        = 'process_status';    
    const PROCESS_COUNT         = 'process_count';
    const LAST_PROCESS          = 'last_process';

    /**
     * Content keys
     */    
    const CONTENT_STATUS        = 'content_status';
}

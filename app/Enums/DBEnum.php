<?php 

namespace App\Enums;


/**
 * DB Enum, aggregate common DB keys
 */ 
class DBEnum extends BaseEnum 
{
    /**
     * Prefixes
     */
    const COLLECTION            = 'c_'; // storage collections prefix    


    /**
     * Processable entities columns
     */
    const LAST_PROCESS          = 'last_process';
    const PROCESS_COUNT         = 'process_count';
    const PROCESS_STATUS        = 'process_status';


    /**
     * Collections
     */    
    const COLLECTION_STATUS     = 'collection_status';
}

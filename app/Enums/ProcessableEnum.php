<?php 

namespace App\Enums;

use App\Enums\ChannelEnum as Channel;

//use App\Enums\ProcessableEnum as Processable;


/**
 * Processable Enum
 */ 
class ProcessableEnum extends BaseEnum 
{
    /**
     * Processes keys 
     * the keys that represent each process
     */
    const KEY_ALIEXPRESS_CATEGORIES             = Channel::ALIEXPRESS . '_categories';
    const KEY_ALIEXPRESS_ITEMS                  = Channel::ALIEXPRESS . '_items';
    const KEY_SHOPIFY_SITES                     = Channel::SHOPIFY . '_sites';


    /**
     * Processable collections db tables
     * db tables that store's process's collections
     */  
    const TABLE_PROCESESS                       = 'processes';
    const TABLE_PREFIX_COLLECTION               = 'c_'; 
    const TABLE_ALIEXPRESS_CATEGORIES           = self::TABLE_PREFIX_COLLECTION . self::KEY_ALIEXPRESS_CATEGORIES;
    const TABLE_ALIEXPRESS_ITEMS                = self::TABLE_PREFIX_COLLECTION . self::KEY_ALIEXPRESS_ITEMS;
    const TABLE_SHOPIFY_SITES                   = self::TABLE_PREFIX_COLLECTION . self::KEY_SHOPIFY_SITES;


    /**
     * Processes settings fields
     * common settings fileds for processable entities
     */
    const PROCESS_COUNT                         = 'process_count'; // process counter, incremented in each process flight
    const LAST_PROCESS                          = 'last_process'; // updated in each process flight
    const SLEEP_TIME                            = 'sleep_time'; // for how long the process should be disabled after the last flight (in minutes)
    const MULTIPLE_LIMIT                        = 'multiple_limit'; // how many "awake" processable records should be processed in single process flight 
   
    
    /**
     * Process active status
     * 
     */    
    const ACTIVE_STATUS                         = 'active_status';  // toggle process active will run based on cron times / pasued will be skipped even on cron trigger 
    const ACTIVE_STATUS_PAUSED                  = 0;
    const ACTIVE_STATUS_ACTIVE                  = 1;    


    /**
     * Process store respone status
     * 
     */    
    const STORE_RESPONSE                        = 'store_response'; // if the response of the process should be stored in file system backup in addtion to db
    const STORE_RESPONSE_FALSE                  = 0;
    const STORE_RESPONSE_TRUE                   = 1;     


    /**
     * Process public status
     */        
    const PUBLIC_STATUS                         = 'public_status'; // mark the stauts of the processed collection in terms of public visiblity
    const PUBLIC_STATUS_HIDDEN                  = 0; 
    const PUBLIC_STATUS_PUBLISHED               = 1;     


    /**
     * Processes keys aggragation 
     * 
     * @var array
     */
    public static $keys = [
        self::KEY_ALIEXPRESS_CATEGORIES,
        self::KEY_ALIEXPRESS_ITEMS,
        self::KEY_SHOPIFY_SITES   
    ];    
}

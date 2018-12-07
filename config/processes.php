<?php

/*
|--------------------------------------------------------------------------
| Processes config
|--------------------------------------------------------------------------
| Set the channels for each process
|
| @note: 
| after 1st seed in production the key fields can be updated only manually in db
| and should be added to the relevant enum
|
*/
use App\Enums\ChannelEnum as Channels;
use App\Enums\ProcessableEnum as Processable;


return [
    
    /**
     * Set channels
     */
    'channels' => [

        Channels::ALIEXPRESS => [
            'domain'        => 'aliexpress.com',
            'name'          => 'Aliexpress',
            'description'   => 'The Aliexpress marketplace',            
        ],
        Channels::SHOPIFY   => [
            'domain'        => 'myshopify.com',
            'name'          => 'Shopify',
            'description'   => 'Shopify stores',            
        ],                 
        Channels::AMAZON    => [
            'domain'        => 'amazon.com',
            'name'          => 'Amazon',
            'description'   => 'The Amazon marketplace',            
        ],
        Channels::EBAY      => [
            'domain'        => 'ebay.com',
            'name'          => 'Ebay',
            'description'   => 'The Ebay marketplace',            
        ]
    ],


    /**
     * Attach processes to channels
     */
    'channels_processes' => [

        Channels::ALIEXPRESS => [
            Processable::KEY_ALIEXPRESS_CATEGORIES => [
                'name'                  => 'Aliexpress Categories',
                'description'           => 'Scan Aliexpress categories',    
                Processable::ACTIVE_STATUS    => Processable::ACTIVE_STATUS_PAUSED                  
            ],
            Processable::KEY_ALIEXPRESS_ITEMS => [
                'name'                  => 'Aliexpress Category',
                'description'           => 'Scan Aliexpress items from category',                                                            
                Processable::ACTIVE_STATUS    => Processable::ACTIVE_STATUS_PAUSED
            ],            
        ],

        Channels::SHOPIFY => [
            Processable::KEY_SHOPIFY_SITES => [
                'name'                  => 'Shopify Sites',
                'description'           => 'Scan Shopify stores',
                Processable::ACTIVE_STATUS     => Processable::ACTIVE_STATUS_PAUSED
            ],      
        ],      
    ],

    
    /**
     * Set other processable entities
     */
    // 'processes_processable' => [
        // ...
    // ],    


    /**
     * Processes settings
     */
    'settings' => [

        Processable::KEY_ALIEXPRESS_CATEGORIES => [
            'store_bag'     => false // log the bag contents ?
        ],


        Processable::KEY_ALIEXPRESS_ITEMS => [
            'store_bag'     => false,
            'mature_age'    => 60, // in minutes
            'limit'         => 1, 
        ],


        // Processable::CATEGORIES => [

        //     // what should be the minimum age of a process on channel in order to re-run it, by MINUTES ?
        //     // the age of the process checked in db by : processes_channels.last_process           
        //     // if several processes are 'mature' enough, the processor will start to run from the oldest
        //     'mature_channel'    => (60*12), // the categories in the channel can be scanned every 12 hours

        //     'limit_channels'    => 1,         

        //     'auto_publish'      => true,             

        //     'auto_active'       => true,                         
        // ],

        // Processable::ITEMS => [

        //     //TODO: change it to 10 minutes 
        //     'mature_channel'    => 1, // the items in the channel can be scanned every 10 minutes

        //     // how many channels from the 'mature' processes_channels should be processed in each process ?            
        //     'limit_channels'    => 1,    
            
        //     // what should be the minimum age of a scanning process on a storage category in order to re-run it, by MINUTES ?
        //     // the age checked in db by : storage_categories.last_process           
        //     // if several processes are 'mature' enough, the processor will start to run from the oldest
        //     'mature_category'   => 1, // each category in channel can be scanned every 1 hour(s), 

        //     // how many storage categories from the 'mature' storage_categories should be processed in each process ?            
        //     'limit_categories'  => 1,                

        //     // publish fetched storage_items records automatically to the public items table ?
        //     'auto_publish'      => true,             

        //     // activate published storage_items records automatically so the ItemsProcessor will fetch from them items ?
        //     'auto_active'       => true,                     
        // ]

    ],

];

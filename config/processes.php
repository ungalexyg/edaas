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
use App\Enums\{
    ProcessEnum as Processes,
    ChannelEnum as Channels
};


return [


    /**
     * Set available processes
     */    
    'processes' => [

        Processes::CATEGORIES => [
            'name'          => 'Categories',
            'description'   => 'Scan categories in channel',       
        ],        
        Processes::ITEMS => [
            'name'          => 'Items',
            'description'   => 'Scan items in channel',      
        ]
    ],


    /**
     * Set available channels
     */
    'channels' => [

        Channels::ALIEXPRESS => [
            'domain'        => 'aliexpress.com',
            'name'          => 'Aliexpress',
            'description'   => 'The Aliexpress marketplace',            
        ],         
        Channels::AMAZON     => [
            'domain'        => 'amazon.com',
            'name'          => 'Amazon',
            'description'   => 'The Amazon marketplace',            
        ],
        Channels::EBAY       => [
            'domain'        => 'ebay.com',
            'name'          => 'Ebay',
            'description'   => 'The Ebay marketplace',            
        ]
    ],


    /**
     * Enable channels for each process
     */
    'processes_channels' => [

        Processes::CATEGORIES => [          
            Channels::ALIEXPRESS,
            // Channels::AMAZON,
            // Channels::EBAY
        ], 
        Processes::ITEMS => [
            Channels::ALIEXPRESS,
            //Channels::AMAZON,
            //Channels::EBAY
        ], 
    ],


    /**
     * Processes settings
     */
    'settings' => [
        Processes::CATEGORIES => [

            // what should be the minimum age of a process on channel in order to re-run it, by MINUTES ?
            // the age of the process checked in db by : processes_channels.last_process           
            // if several processes are 'mature' enough, the processor will start to run from the oldest
            'mature_channel'    => (60*12), // the categories in the channel can be scanned every 12 hours

            'limit_channels'    => 1,         

            'auto_publish'      => true,             

            'auto_active'       => true,                         
        ],

        Processes::ITEMS => [

            //TODO: change it to 10 minutes 
            'mature_channel'    => 1, // the items in the channel can be scanned every 10 minutes

            // how many channels from the 'mature' processes_channels should be processed in each process ?            
            'limit_channels'    => 1,    
            
            // what should be the minimum age of a scanning process on a storage category in order to re-run it, by MINUTES ?
            // the age checked in db by : storage_categories.last_process           
            // if several processes are 'mature' enough, the processor will start to run from the oldest
            'mature_category'   => 60, // each category in channel can be scanned every 1 hour(s), 

            // how many storage categories from the 'mature' storage_categories should be processed in each process ?            
            'limit_categories'  => 1,                

            // publish fetched storage_items records automatically to the public items table ?
            'auto_publish'      => true,             

            // activate published storage_items records automatically so the ItemsProcessor will fetch from them items ?
            'auto_active'       => true,                     
        ]
    ],

];

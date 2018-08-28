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
use App\Enums\ProcessEnum as Processes;
use App\Enums\ChannelEnum as Channels;


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

        // what should be the minimum age of a process in order to run it by MINUTES ?
        // the age of the process checked by : channels_processes.last_process.            
        // if several processes are 'mature' enough, the processor will start to run from the oldest
        'min_age' => (60*24), // 24 hours in minutes, 

        // how many from the 'mature' process_channels should be processed in each process ?            
        'limit_channels' => 2,         

        Processes::ITEMS => [
        ],
        Processes::CATEGORIES => [
            // publish fetched storage_category records automatically to the public category table ?
            'auto_publish' => true,             

            // activate published storage_category records automatically so the ItemsProcessor will fetch from them items ?
            'auto_active' => false,                         
        ] 
    ],

];

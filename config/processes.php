<?php

/*
|--------------------------------------------------------------------------
| Processes config
|--------------------------------------------------------------------------
| Set the channels for each process
|
| @note: 
| after 1st seed the key fields can be update only manually in db
| and should be added to the relevant enum
|
*/
use App\Lib\Enums\Processes;
use App\Lib\Enums\Channels;


return [


    /**
     * Set available processes
     */    
    'processes' => [

        Processes::ITEMS => [
            'name'          => 'Items',
            'description'   => 'Scan items in channel',      
        ],
        Processes::CATEGORIES => [
            'name'          => 'Categories',
            'description'   => 'Scan categories in channel',       
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
     * Enable processes for each channel
     */
    'channels_processes' => [

        Channels::ALIEXPRESS => [
            Processes::ITEMS,
            Processes::CATEGORIES,           
        ],
        Channels::AMAZON     => [
            Processes::ITEMS,
            Processes::CATEGORIES,          
        ],
        Channels::EBAY       => [
            Processes::ITEMS,
            Processes::CATEGORIES,
        ]  
    ],


    /**
     * Processes settings
     */
    'settings' => [

        Processes::ITEMS => [
        ],
        Processes::CATEGORIES => [
            // what should be the minimum age of a process in order to run it by MINUTES ?
            // the age of the process checked by : channels_processes.last_process.            
            // if several processes are 'mature' enough, the processor will start to run from the oldest
            'min_age' => (60*24), // 24 hours in minutes, 

            // how many from the 'mature' process_channels should be processed in each process ?            
            'limit_channels' => 2, 
        ] 
    ],

];

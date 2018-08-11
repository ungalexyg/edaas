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
use App\Lib\Enums\Process;
use App\Lib\Enums\Channel;


return [


    /**
     * Set available processes
     */    
    'processes' => [

        Process::ITEMS => [
            'name'          => 'Items',
            'description'   => 'Scan items in channel',      
        ],
        Process::CATEGORIES => [
            'name'          => 'Categories',
            'description'   => 'Scan categories in channel',       
        ]
    ],


    /**
     * Set available channels
     */
    'channels' => [

        Channel::ALIEXPRESS => [
            'domain'        => 'aliexpress.com',
            'name'          => 'Aliexpress',
            'description'   => 'The Aliexpress marketplace',            
        ],
        Channel::AMAZON     => [
            'domain'        => 'amazon.com',
            'name'          => 'Amazon',
            'description'   => 'The Amazon marketplace',            
        ],
        Channel::EBAY       => [
            'domain'        => 'ebay.com',
            'name'          => 'Ebay',
            'description'   => 'The Ebay marketplace',            
        ]  
    ],


    /**
     * Enable processes for each channel
     */
    'processes_channels' => [

        Channel::ALIEXPRESS => [
            Process::ITEMS,
            Process::CATEGORIES,           
        ],
        Channel::AMAZON     => [
            Process::ITEMS,
            Process::CATEGORIES,          
        ],
        Channel::EBAY       => [
            Process::ITEMS,
            Process::CATEGORIES,
        ]  
    ]
];

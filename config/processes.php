<?php

/*
|--------------------------------------------------------------------------
| Processes config
|--------------------------------------------------------------------------
| Set the channels for each process
|
*/
use App\Lib\Enums\Process;
use App\Lib\Enums\Channel;


return [


    Process::CATEGORIES => [
        Channel::ALIEXPRESS,
        Channel::AMAZON,
        Channel::EBAY,
    ],
    
    Process::ITEMS => [
        Channel::ALIEXPRESS,
        Channel::AMAZON,
        Channel::EBAY,
    ]    

];

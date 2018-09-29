<?php 
namespace App\Processes\Setter;

use App\Processes\Setter\Traits\ProcessesSeeder;
use App\Processes\Setter\Traits\ChannelsMigrator;
use App\Processes\Setter\Traits\ChannelsAttacher;


/**
 * Processor Setter
 * 
 * Handle Processor logistics.
 */ 
class ProcessesSetter  
{
    /**
     * Use processes setter traits
     */
    use ProcessesSeeder, ChannelsMigrator, ChannelsAttacher;
}

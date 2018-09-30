<?php 
namespace App\Processes\Setter;

use App\Processes\Setter\Traits\ProcessesSeeder;
use App\Processes\Setter\Traits\ChannelsAttacher;


/**
 * Processor Setter
 * 
 * Handle Processor logistics.
 */ 
class ProcessesSetter implements IProcessesSetter 
{
    /**
     * Use processes setter traits
     */
    use ProcessesSeeder, ChannelsAttacher;
}

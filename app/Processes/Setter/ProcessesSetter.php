<?php 
namespace App\Processes\Setter;

use App\Processes\Setter\Traits\{ ChannelsAttacher, StorageMigrator };


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
    use ChannelsAttacher, StorageMigrator;
}




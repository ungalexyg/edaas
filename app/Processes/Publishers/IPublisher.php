<?php 

namespace App\Processes\Publishers;

use App\Processes\Processors\Base\IProcess;


/**
 * Publisher Interface 
 */ 
interface IPublisher extends IProcess 
{
    /**
	 *  Publish data from the storage 
	 * 
	 * @return void
     */
    public function publish();	
}




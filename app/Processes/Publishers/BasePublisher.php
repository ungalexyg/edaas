<?php 

namespace App\Processes\Publishers;

use App\Processes\Traits\HasProcess;


/**
 * Base Publisher
 * 
 * Publish the stored data by syncing it from the storage to the published tables
 */ 
abstract class BasePublisher implements IPublisher 
{
	/**
	 * Use process traits
	 */
	use HasProcess;


    /**
	 * Publish data from the storage 
	 * 
	 * @return void
     */
    abstract public function publish();		
}




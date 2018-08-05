<?php 

/**
 * --------------------------------------------------------------------------
 *  Keeper 
 * --------------------------------------------------------------------------
 * 
 * The Keeper Process organise & transform scanned raw data into stactured records
 * which will be used in the application.
 * This is the last point of the process which deals with data collection before insertion.
 */ 

namespace App\Processes\Keepers;
use App\Processes\Base\BaseProcess; 

/**
 * Base Keeper
 */ 
abstract class BaseKeeper extends BaseProcess implements IKeeper {


	/**
	 * Start a process
	 * 
	 * @return mixed
	 */
	public function start() 
	{
		return $this->keep();
	}

}




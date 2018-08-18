<?php 

namespace App\Processes\Keepers;

use App\Processes\Traits\HasProcess;


/**
 * Base Keeper
 * 
 * The Keeper Process organise & transform scanned raw data into stactured records
 * which will be used in the application.
 * This is the last point of the process which deals with data collection before insertion.
 */ 
abstract class BaseKeeper implements IKeeper 
{

	/**
	 * Use process traits
	 */
	use HasProcess;


    /**
     * Handle process action
	 * 
	 * @return self
     */
	abstract public function handle();


	/**
	 * Keep process data
	 * 
	 * @return self
	 */
	abstract public function keep();	
	
}




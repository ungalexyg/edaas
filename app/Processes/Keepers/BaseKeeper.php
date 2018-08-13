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

use App\Processes\Base\Processor;
use App\Exceptions\KeeperException;
use App\Processes\Base\Traits\HasProcessKit;

/**
 * Base Keeper
 */ 
abstract class BaseKeeper implements IKeeper {


	/**
	 * Use process kit
	 */
	use HasProcessKit;


	/**
	 * Start a process
	 * 
	 * @return mixed
	 */
	public function process() 
	{
		return $this->takeKit()->keep();
	}


	/**
	 * Stop a process
	 * 
	 * @return mixed
	 */	
	public function stop() 
	{
		throw new KeeperException(KeeperException::METHOD_NOT_IMPLEMENTED);
	}


	/**
	 * Get process status data
	 * 
	 * @return mixed
	 */	
	public function status() 
	{
		throw new KeeperException(KeeperException::METHOD_NOT_IMPLEMENTED);
	}


	/**
	 * Keep process data
	 */
	abstract public function keep();	
}




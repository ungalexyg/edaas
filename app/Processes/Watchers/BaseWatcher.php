<?php 
 /**
 * --------------------------------------------------------------------------
 *  Watcher
 * --------------------------------------------------------------------------
 * 
 * The Watcher whatching the realized data, tracking, comparing & mark their performance according to set of conditions across mutiple channels.
 * 
 * TODO: write the conditions
 * 
 * TODO: 
 * check Observers:
 * https://medium.com/sammich-shop/simple-record-history-tracking-with-laravel-observers-48a2e3c5698b
 * 
 * 
 */ 

namespace App\Processes\Watchers;

use App\Processes\Base\Processor;


/**
 * Base Watcher
 */ 
abstract class BaseWatcher extends Processor implements IWatcher {

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
		return $this->watch();
	}

	/**
	 * Stop a process
	 * 
	 * @return mixed
	 */	
	public function stop() 
	{
		throw new WatcherException(WatcherException::METHOD_NOT_IMPLEMENTED);
	}


	/**
	 * Get process status data
	 * 
	 * @return mixed
	 */	
	public function status() 
	{
		throw new WatcherException(WatcherException::METHOD_NOT_IMPLEMENTED);
	}


    /**
     * Compare if record has changes 
     */
	abstract public function compare();
	

    /**
     * Watch prospects
     */
    abstract public function watch();		

}




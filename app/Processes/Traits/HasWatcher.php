<?php 
/**
 * --------------------------------------------------------------------------
 *  Has Watcher  
 * --------------------------------------------------------------------------
 * 
 * Embed Watcher instance to the using class
 */ 

namespace App\Processes\Traits;
// use App\Enums\Channel;
// use App\Enums\Process;
use App\Exceptions\ProcessException;



/**
 * Has Watcher Trait 
 */ 
trait HasWatcher {


	/**
	 * Watcher instance
	 * 
	 * @var IWatcher
	 */
	protected $watcher;	    


	/**
	 * Load Watcher
	 * 
	 * @throws ProcessException
	 * @return self
	 */	
	protected function loadWatcher() 
	{			
		$watcher = 'App\Processes\Watchers\\' . ucwords($this->process) . 'Watcher';
	
		if (!class_exists($watcher))  throw new ProcessException(ProcessException::UNDEFINED_WATCHER);

		$this->watcher = new $watcher();		

		$this->watcher->setProcessor($this);

		return $this;
	}		    

}
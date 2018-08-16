<?php 
/**
 * --------------------------------------------------------------------------
 *  Has Watcher  
 * --------------------------------------------------------------------------
 * 
 * Embed Watcher instance to the using class
 */ 

namespace App\Processes\Traits;
// use App\Lib\Enums\Channel;
// use App\Lib\Enums\Process;
use App\Exceptions\ProcessorException;



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
	 * @throws ProcessorException
	 * @return self
	 */	
	protected function loadWatcher() 
	{			
		$watcher = 'App\Processes\Watchers\\' . ucwords($this->process) . 'Watcher';
	
		if (!class_exists($watcher))  throw new ProcessorException(ProcessorException::PROCESSOR_WATCHER_UNDEFINED);

		$this->watcher = new $watcher();		

		$this->watcher->setProcessor($this);

		return $this;
	}		    

}
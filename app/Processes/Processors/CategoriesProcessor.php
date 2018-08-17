<?php 

namespace App\Processes\Processors;

//use App\Exceptions\ProcessException;
use App\Processes\Traits\HasKeeper;
use App\Processes\Traits\HasProcess;
use App\Processes\Traits\HasScanner;
use App\Processes\Traits\HasWatcher;
use App\Processes\Processors\Base\IProcessor;


/**
 * Categories Processor 
 * 
 * Run categories processes
 */ 
class CategoriesProcessor implements IProcessor {

	/**
	 * Processes traits
	 */
	use HasProcess, HasScanner, HasKeeper, HasWatcher;


	/**
	 * Load processor dependencies
	 * 
	 * @return self
	 */	
	public function load() 
	{	
		return $this->loadScanner()->loadKeeper()->loadWatcher(); 
	}


	/**
	 * Manage the process
	 */
	public function process() 
	{
		$this->scanner->pull()->handle()->push();
		$this->keeper->pull()->handle()->push();
		$this->watcher->pull()->handle()->push();
		
		echo '<pre>'; print_r($this->bag);
	}
}




<?php 

namespace App\Processes\Processors;

//use App\Exceptions\ProcessorException;
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
	 * Perform the process
	 */
	public function process() 
	{
		
		$this->scanner->handle();
		$this->keeper->handle();
		$this->watcher->handle();
		
		echo '<pre>'; print_r($this->bag);
	}

}




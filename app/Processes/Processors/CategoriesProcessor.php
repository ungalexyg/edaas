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
class CategoriesProcessor implements IProcessor 
{

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
	 * 
	 * TODO: if the bag is empty, exception + report
	 * 
	 */
	public function process() 
	{
		$this->scanner->pull()->scan()->push();
		
		$this->keeper->pull()->store()->publish()->push();
		
		$this->watcher->pull()->watch()->push();
		
		echo '<pre><hr />'; print_r($this->bag);
	}
}

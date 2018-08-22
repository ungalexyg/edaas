<?php 

namespace App\Processes\Processors;

//use App\Exceptions\ProcessException;
use App\Processes\Traits\HasKeeper;
use Illuminate\Support\Facades\Log;
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
	use HasProcess, HasScanner, HasKeeper;


	/**
	 * Load processor dependencies
	 * 
	 * @return self
	 */	
	public function load() 
	{	
		return $this->loadScanner()->loadKeeper();
	}


	/**
	 * Manage the process
	 * 
	 * @return void
	 */
	public function process() 	
	{
		$this->scanner->pull()->scan()->push();
		
		$this->keeper->pull()->store();
		
        Log::channel('processes')->info('process completed', ['location' => __METHOD__ .':'.__LINE__ ]);
		
		echo '<pre><hr />'; print_r($this->bag);
	}
}

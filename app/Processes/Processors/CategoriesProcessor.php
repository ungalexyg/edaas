<?php 

namespace App\Processes\Processors;

use Log;
use App\Processes\Processors\Base\BaseProcessor;


/**
 * Categories Processor 
 * 
 * Manage categories processes
 */ 
class CategoriesProcessor extends BaseProcessor 
{
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
	 * @return array $this->response()
	 */
	public function process() 	
	{
		$this->scanner->pull()->scan()->push();
		
		$this->keeper->pull()->store();
		
		if(($this->config['auto_publish'] ?? false)) 
		{			
			$this->keeper->push();

			$this->loadPublisher()->publisher->pull()->publish();
		}

		return $this;
	}		
}

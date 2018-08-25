<?php 

namespace App\Processes\Processors;

use App\Processes\Processors\Base\BaseProcessor;


/**
 * Items Processor 
 * 
 * Run items processes
 */ 
class ItemsProcessor extends BaseProcessor
{
	/**
	 * The categories for process scan
	 */
	protected $categories; 


	/**
	 * Load processor dependencies
	 * 
	 * @return self
	 */	
	public function load() 
	{	
		$this->setCategoiries();
	}


	/**
	 * Set categories to scan items from
	 */
	protected function setCategoiries() 
	{
	
	}
}

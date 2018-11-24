<?php 

namespace App\Processes\Base;


/**
 * Base Processor 
 */ 
abstract class BaseProcessor implements IProcessor  
{
	/**
	 * Perform the process
	 * 
	 * @return self
	 */
	abstract public function process();	


	/**
	 * Update process timestamp
	 * 
	 * @return self
	 */
	abstract public function stamp(); 	
}

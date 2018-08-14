<?php 

namespace App\Processes\Processors\Base;


/**
 * Process Interface 
 */ 
interface IProcessor {

	
	/**
	 * Load processor dependencies
	 * 
	 * @return self
	 */	
	public function load();	



	/**
	 * Perform the process
	 * 
	 * @return self
	 */
	public function process();	

}




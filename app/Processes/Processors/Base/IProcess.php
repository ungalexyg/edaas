<?php 

namespace App\Processes\Processors\Base;


/**
 * Process Interface 
 */ 
interface IProcess {

	
	/**
	 * Pull common process properties from the processor
	 * 
	 * @param array $properties
	 * @return self
	 */
	public function pull($properties=[]); 



	/**
	 * Push common process properties to the processor
	 * 
	 * @param array $properties
	 * @return self
	 */
	public function push($properties=[]); 

	
}




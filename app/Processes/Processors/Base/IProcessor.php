<?php 

namespace App\Processes\Processors\Base;


/**
 * Processor Interface 
 */ 
interface IProcessor extends IProcess 
{
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


	/**
	 * Update process timestamp
	 * 
	 * @return self
	 */
	public function stamp();	
}




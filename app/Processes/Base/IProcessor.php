<?php 

namespace App\Processes\Base;


/**
 * Channel Processor Interface 
 */ 
interface IProcessor
{
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
	
	
	/**
	 * Generate process response
	 * 
	 * @return array $response
	 */
	public function response();			
}

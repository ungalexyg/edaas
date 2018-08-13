<?php 
namespace App\Processes\Base;


/**
 * Process Interface 
 */ 
interface IProcessor {

	/**
	 * Start a process
	 */
	public function process();


	/**
	 * Get process status data
	 */	
	public function start();	


	/**
	 * Get process status data
	 */	
	public function status();	


	/**
	 * Adapter getter
	 */	
	public function adapter(); 

}




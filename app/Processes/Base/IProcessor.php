<?php 
namespace App\Processes\Base;


/**
 * Process Interface 
 */ 
interface IProcessor {

	/**
	 * Start a process
	 */
	public function start();


	/**
	 * Stop a process
	 */	
	public function stop();


	/**
	 * Get process status data
	 */	
	public function status();	

}




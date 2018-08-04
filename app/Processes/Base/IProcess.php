<?php 
namespace App\Processes\Base;


/**
 * Process Interface 
 */ 
interface IProcess {

	/**
	 * Start a process
	 */
	public function start();


	/**
	 * Stop a process
	 */	
	public function stop();

}




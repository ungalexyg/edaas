<?php 

namespace App\Processes\Processors\Base;


/**
 * Main Processor Interface 
 */ 
interface IMainProcessor extends IProcess 
{

	/**
	 * Run pre process operations
	 * 
	 * @param string $process
	 */
	public function run($process); 


	/**
	 * Perform specific action
	 * 
	 * Typcally actions are part of process & this method is a 
	 * short cut to run specific action without initiating full process.
	 * 
	 * @param string $action
	 */	
	//public function action($action);	

}




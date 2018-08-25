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
}




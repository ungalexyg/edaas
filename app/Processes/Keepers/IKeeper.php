<?php 

namespace App\Processes\Keepers;

use App\Processes\Processors\Base\IProcess;


/**
 * Keeper Interface
 */ 
interface IKeeper extends IProcess 
{
    /**
     * Handle process action
	 * 
	 * @return self
     */
	public function handle();


	/**
	 * Keep process data
	 * 
	 * @return self
	 */
	public function keep();

}




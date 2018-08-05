<?php 
namespace App\Processes\Keepers;

use App\Processes\Base\IProcess;


/**
 * Keeper Interface
 */ 
interface IKeeper extends IProcess {

	/**
	 * Keep process data
	 */
	public function keep();

}




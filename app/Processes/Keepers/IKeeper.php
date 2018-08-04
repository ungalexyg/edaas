<?php 
namespace App\Processes\Keeprs;

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




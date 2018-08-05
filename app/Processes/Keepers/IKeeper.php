<?php 
namespace App\Processes\Keepers;

use App\Processes\Base\IProcessor;


/**
 * Keeper Interface
 */ 
interface IKeeper extends IProcessor {

	/**
	 * Keep process data
	 */
	public function keep();

}




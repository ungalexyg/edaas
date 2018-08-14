<?php 
namespace App\Processes\Keepers;


/**
 * Keeper Interface
 */ 
interface IKeeper {

    /**
     * Handle process action
     */
	public function handle();


	/**
	 * Keep process data
	 */
	public function keep();

}




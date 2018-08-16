<?php 
namespace App\Processes\Keepers;


/**
 * Keeper Interface
 */ 
interface IKeeper {

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




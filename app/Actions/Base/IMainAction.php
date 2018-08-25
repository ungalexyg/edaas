<?php 

namespace App\Actions\Base;


/**
 * Main Action Interface 
 */ 
interface IMainAction 
{
	/**
	 * Initiate IAction instance & perform it's handler
	 * 
	 * @param string App\Enums\Actions::$action
	 * @return array $response
	 */	
	public function do($action);	
}




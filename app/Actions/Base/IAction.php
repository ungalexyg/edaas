<?php 

namespace App\Actions\Base;


/**
 * Action Interface 
 */ 
interface IAction
{
	/**
	 * Handle action
	 * 
	 * @return self
	 */	
	public function handle();	


	/**
	 * Return action's response
	 * 
	 * @return array
	 */
	public function response();	
}




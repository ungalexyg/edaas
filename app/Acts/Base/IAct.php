<?php 

namespace App\Acts\Base;

use App\Enums\Contracts\IActEnum;


/**
 * Act Interface 
 */ 
interface IAct
{
	/**
	 * Validate Act input
	 * 
	 * @return self
	 */	
	public function validate(); 

	/**
	 * Execute an Act
	 * 
	 * @return self
	 */	
	public function execute();	


	/**
	 * Return Act's response
	 * 
	 * @return array
	 */
	public function response();	
}




<?php 

namespace App\Acts\Base;


/**
 * Act Interface 
 */ 
interface IAct
{
	/**
	 * Handle Act
	 * 
	 * @return self
	 */	
	public function handle();	


	/**
	 * Return Act's response
	 * 
	 * @return array
	 */
	public function response();	
}




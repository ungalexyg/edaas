<?php 

namespace App\Acts\Base;

use App\Enums\Contracts\IActsEnum;


/**
 * Act Interface 
 */ 
interface IAct extends IActsEnum 
{
	/**
	 * Perform an Act
	 * 
	 * @return self
	 */	
	public function perform();	


	/**
	 * Return Act's response
	 * 
	 * @return array
	 */
	public function response();	
}




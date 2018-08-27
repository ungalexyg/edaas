<?php 

namespace App\Acts\Base;

use App\Enums\Contracts\IActsEnum;


/**
 * Main Act Interface 
 */ 
interface IMainAct extends IActsEnum  
{
	/**
	 * Initiate IAct instance & perform it's handler
	 * 
	 * @param string App\Enums\Acts::$Act
	 * @return array $response
	 */	
	//public function do($Act);	
}




<?php 

namespace App\Acts\Base;

use Log;
use App\Acts\Traits\HasAct;
use App\Acts\Traits\HasActProcess;
use App\Exceptions\Acts\ActException;


/**
 * Main Act 
 * 
 * Load Act instances & perform their handlers
 */ 
final class MainAct implements IMainAct  
{
	/**
	 * Acts traits
	 */
	use HasAct;

	/**
	 * Initiate IAct instance & perform it's handler
	 * 
	 * @param string App\Enums\Acts::$Act
	 * @param array $params
	 * @return array $response
	 */	
	public function __construct($Act, $params=[])
	{
		try 
		{
			return $this->loadAct($Act, $params)->Act->handle()->response();
		}
		catch(\Exception $e) 
		{
			return [
				'exception' => get_class($e),
				'message' => $e->getMessage()
			];
		}
	}
}




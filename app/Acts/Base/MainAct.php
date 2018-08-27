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
	 * The act performed in try catch block since 
	 * it runs in processes which shouldn't be stopped by exceptions.
	 * 
	 * usage: Act::do(Act::SOMETHING, $params);
	 * 
	 * @param string App\Enums\IActsEnum::$act 
	 * @param array $params
	 * @return array $response
	 */	
	public static function do($act, $params=[])
	{
		try 
		{
			return static::loadAct($act, $params)->perform()->response();
		}
		catch(\Exception $e) 
		{
			return [
				'exception' => get_class($e),
				'message' => $e->getMessage(),
				'file' => $e->getFile(),
				'line' => $e->getLine()
			];
		}
	}
}




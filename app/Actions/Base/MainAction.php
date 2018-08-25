<?php 

namespace App\Actions\Base;

use Log;
use App\Actions\Traits\HasAction;
use App\Actions\Traits\HasActionProcess;
use App\Exceptions\Actions\ActionException;


/**
 * Main Action 
 * 
 * Load action instances & perform their handlers
 */ 
final class MainAction implements IMainAction  
{
	/**
	 * Actions traits
	 */
	use HasAction;

	/**
	 * Initiate IAction instance & perform it's handler
	 * 
	 * @param string App\Enums\Actions::$action
	 * @param array $params
	 * @return array $response
	 */	
	public function __construct($action, $params=[])
	{
		try 
		{
			return $this->loadAction($action, $params)->action->handle()->response();
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




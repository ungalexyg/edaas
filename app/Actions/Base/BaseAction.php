<?php 

namespace App\Actions\Base;

use Log;


/**
 * Base Action
 */ 
abstract class BaseAction implements IAction  
{
	/**
	 * Action key
	 * 
	 * @var null|string
	 */
	public $key;


	/**
	 * Action params
	 * 
	 * @var array
	 */
	public $params = [];
		

	/**
	 * Action message
	 * 
	 * @var null|string
	 */
	public $message;


	/**
	 * Handle action
	 * 
	 * @return self
	 */	
	abstract public function handle();	


	/**
	 * Generate action response
	 * and log action's message
	 * 
	 * @return array $response
	 */
	public function response() 
	{
		if(!$this->message) 
		{
			$this->message = 'the action '. $this->key .' completed';
		}

		Log::channel(Log::ACTIONS)->info($this->message, ['in' => __METHOD__ .':'.__LINE__]);

		return ['message' => $this->message];
	}		
}




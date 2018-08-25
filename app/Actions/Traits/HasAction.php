<?php 

namespace App\Actions\Traits;

use App\Enums\Actions;
use App\Actions\Base\IAction;
use App\Exceptions\Actions\ActionException;


/**
 * Has Action Trait 
 * 
 * Embed Action instance to the using class
 */ 
trait HasAction 
{
	/**
	 * Action instance
	 * 
	 * @var IAction
	 */
	protected $action;	     


	/**
	 * Load Scanner
	 * 
	 * @param string $key // action key
	 * @param array $params // action params
	 * @throws ActionException
	 * @return self
	 */	
	protected function loadAction($key, $params=[]) 
	{	
		if(!in_array($key, Actions::getConstants())) throw new ActionException(ActionException::UNDEFINED_ACTION_KEY);

		list($entity, $action) = explode('@', $key);

        $class = 'App\Actions\\' . $entity . '\\' . ucwords($action) . 'Action';

		$this->action = new $class();			
		
		if(!($this->action instanceof IAction)) throw new ActionException(ActionException::INVALID_ACTION_INSTANCE);

		$this->action->key = $key;
		
		$this->action->params = $params;

        return $this;
	}	    
}
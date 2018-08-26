<?php 

namespace App\Acts\Traits;

use App\Enums\Acts;
use App\Acts\Base\IAct;
use App\Exceptions\Acts\ActException;


/**
 * Has Act Trait 
 * 
 * Embed Act instance to the using class
 */ 
trait HasAct 
{
	/**
	 * Act instance
	 * 
	 * @var IAct
	 */
	protected $act;	     


	/**
	 * Load Scanner
	 * 
	 * @param string $key // Act key
	 * @param array $params // Act params
	 * @throws ActException
	 * @return self
	 */	
	protected function loadAct($key, $params=[]) 
	{	
		if(!in_array($key, Acts::getConstants())) throw new ActException(ActException::UNDEFINED_Act_KEY);

		list($entity, $Act) = explode('@', $key);

        $class = 'App\Acts\\' . $entity . '\\' . ucwords($Act) . 'Act';

		$this->act = new $class();			
		
		if(!($this->act instanceof IAct)) throw new ActException(ActException::INVALID_Act_INSTANCE);

		$this->act->key = $key;
		
		$this->act->params = $params;

        return $this;
	}	    
}
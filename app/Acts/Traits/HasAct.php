<?php 

namespace App\Acts\Traits;

use App\Acts\Base\IAct;
use App\Enums\ActsEnum;
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
	protected static $act;	     


	/**
	 * Load Scanner
	 * 
	 * @param string $key // Act key
	 * @param array $params // Act params
	 * @throws ActException
	 * @return IAct
	 */	
	protected static function loadAct($key, $params=[]) 
	{	
		if(!in_array($key, ActsEnum::getConstants())) throw new ActException(ActException::UNDEFINED_Act_KEY);

		list($entity, $Act) = explode('@', $key);

        $class = 'App\Acts\\' . $entity . '\\' . ucwords($Act) . 'Act';

		static::$act = new $class();			
		
		if(!(static::$act instanceof IAct)) throw new ActException(ActException::INVALID_Act_INSTANCE);

		static::$act->key = $key;
		
		static::$act->params = $params;

		return static::$act;
	}	    
}
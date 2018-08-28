<?php 

namespace App\Acts\Base;

use Log;
use App\Enums\Contracts\IActEnum;
use App\Exceptions\Acts\ActException as Exception;


/**
 * Main Act 
 * 
 * Load Act instances & perform their handlers
 */ 
final class MainAct implements IActEnum  
{
	/**
	 * Act instance
	 * 
	 * @var IAct
	 */
	private static $act;	     



	/**
     * Perform an act 
     * 
     * This method serve as container for most of the actions in the applications.
	 * It works as alternative to repository pattern, which loads repository with all the actions of an entity in all the scnerios.
     * However, the 'Act' approach split the actions by loading single IAct instance to perform specifc action related to entity. 
	 * And the entity itself, used just as pointer for classfication.    
     * In short, each method in the repository pattren converted to IAct instance that execute specific case.  
	 * 
	 * @usage: Act::perform(Act::SOMETHING, $params);
	 * @usage: act($act, $params);
	 * @see App\Lib\helpers.php act()
     * @param string $act App\Enums\Contracts\IActEnum::$act 
	 * @param array $params
     * @return array $response
	 */	
	public static function perform($act, $params=[])
	{
		try 
		{
			return static::loadAct($act, $params)->execute()->response();
		}
		catch(\Exception $e) 
		{
			return [
				'exception' => get_class($e),
				'message' 	=> $e->getMessage(),
				'file' 		=> $e->getFile(),
				'line' 		=> $e->getLine()
			];
		}
	}	


	/**
	 * Load Act
	 * 
	 * @param string $key // Act key
	 * @param array $params // Act params
	 * @throws ActException
	 * @return IAct
	 */	
	private static function loadAct($key, $params=[]) 
	{	
		list($model, $act) = explode('@', $key);

        $class = 'App\Acts\\' . $model . '\\' . ucwords($act) . 'Act';

		if (!class_exists($class))  throw new Exception(Exception::UNDEFINED_ACT);

		static::$act = new $class();			
		
		if(!(static::$act instanceof IAct)) throw new Exception(Exception::INVALID_ACT);

		return static::$act->seKey($key)->setParams($params)->loadModel($model);
	}	    	
}




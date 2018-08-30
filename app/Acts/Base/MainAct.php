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
	 * Act entity 
	 * 
	 * @var string
	 */
	private static $entity;	     
	

	/**
	 * Act action
	 * 
	 * @var string
	 */
	private static $action;	     


	/**
	 * Act model 
	 * 
	 * @var string|object
	 */
	private static $model;		










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
     * @param string|array $reference act reference
	 * @param array $input
     * @return array $response
	 */	
	public static function perform($reference, $input=[])
	{
		try 
		{
			$response = static::loadAct($reference, $input)->execute()->response();
			
			unset(static::$act);
			
			return $response;
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
	 * @param string|array $reference act reference 
	 * @param array $input // Act input
	 * @throws ActException
	 * @return IAct
	 */	
	private static function loadAct($reference, $input=[]) 
	{			
		static::extractReference($reference);

		$act = 'App\Acts\\' . static::$entity . '\\' . ucwords(static::$action) . 'Act';		

		$model = 'App\Models\\' . static::$entity;			

		if(!class_exists($act))  throw new Exception(Exception::UNDEFINED_ACT);

		static::$act = new $class();			
		
		if(!(static::$act instanceof IAct)) throw new Exception(Exception::INVALID_ACT);

		return static::$act->setInput($input)->setModel($model);
	}	   
	
	
	/**
	 * Extract act reference
	 * 
	 * @param string|array $reference key:  'Model@action' | [Model::class, 'action'] 
	 * @throws ActException
	 * @return void
	 */
	public static function extractReference($reference) 
	{
		// handle string ref: 'Model@action', 
		// we get the entity name & need to build related model path
		if(is_string($reference)) 
		{
			list(static::$entity, static::$action) = explode('@', $reference);
		}
		// handle array ref: [Model::class, 'action'], 
		// we get the model path & need to extract entity name
		elseif(is_array($reference)) 
		{
			list($model, static::$action) = $reference;		

			if(Lara::isEloquent($model)) 
			{				
				if(Lara::isEloquentInstance($model)) 
				{
					static::$model = &$model;
				}
			}	
	
			// 	$class = get_class($category);
			// 	$class = explode('\\', $class);
			// 	$class = end($class);


            $parts = explode('\\', $model);

            static::$entity = end($parts);			
		}
		// invalid reference, throw exception 		
		else 
		{
			throw new Exception(Exception::INVALID_REFERENCE . ' | reference: ' . var_export($reference, 1));
		}
	}	
}




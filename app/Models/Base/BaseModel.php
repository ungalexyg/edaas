<?php

namespace App\Models\Base;

use Log;
use Validator;
use App\Exceptions\Models\BaseModelException as Exception;
use Illuminate\Database\Eloquent\Model as CoreModel;


/**
 * Base Model
 */
abstract class BaseModel extends CoreModel implements IModel
{
	/**
	 * Model traits
	 */
	use Singelton;

	
	/**
	 * Called method
	 * 
	 * @var string
	 */
	protected $method;	


	/**
	 * Action input
	 * 
	 * @var array
	 */
	protected $input;


	/**
	 * Action entity
	 * 
	 * @var mixed
	 */
	protected $entity;


	/**
	 * Act validator instance
	 * 
	 * @var Validator
	 */
	protected $validator;
	

	/**
	 * Messages bag
	 * 
	 * @var array
	 */
	protected $messages=[];


	/**
	 * Affected bag
	 * 
	 * @var array
	 */
	protected $affected=[];


	/**
	 * Handle model's acts flow 
	 * 
	 * The method perform full act flow process,
	 * which includes input parsing, validation, execution & response.
	 * 
	 * The input can be array or eloquent model instance when performing action on specific instance
	 * e.g :
	 * array when perform general action : 
	 * StorageCategory::perform('customAct', ['key' => $value]) 
	 * StorageCategory::perform('activate', $StorageCategory)
	 * 
	 * Regular usage of act methods is also allowed, e.g :
	 * StorageCategory::activate($StorageCategory);
	 * However, it won't perform the full flow  
	 * 
	 * @param string $method
	 * @param mixed $input
	 * @throws \Exception
	 * @return void
	 */	
    public static function perform($method, $input=[])
	{		
		try 
		{
			static::init($method, $input);

			static::$self->validate() ? static::$self->execute() : null;
			
			return static::$self->response();
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
	 * Check if flow exist for the called method
	 * if exits, will init the instance with necessary setters
	 * 
	 * @param string $method
	 * @param mixed $input
	 * @return bool
	 */
	public static function init($method, $input) 
	{
		$class = get_called_class();
				
		static::self($class)->setMethod($method)->setInput($input);
		
		return true;
	}


	/**
	 * Set method
	 * 
	 * @param string $method
	 * @return void
	 */
	protected function setMethod($method) 
	{
		if(!method_exists(static::$self, $method)) throw new Exception(Exception::INVALID_METHOD . ' | called method: '. $method);

		$this->method = $method;

		return static::$self;
	}


	/**
	 * Set input
	 * 
	 * the input can be array or eloquent model instance
	 * 
	 * e.g :
	 * StorageCategory::perform('activate', ['id' => $id])
	 * StorageCategory::perform('activate', $StorageCategory)
	 * 
	 * @param array|Illuminate\Database\Eloquent\Model $input
	 * @return self
	 */	
	protected function setInput($input) 
	{
		is_array($input) ? $this->input = $input : $this->setEntity($input); 		

		return static::$self;		
	}	

	
	/**
	 * Set entity
	 * 
	 * @param array|Illuminate\Database\Eloquent\Model $entity
	 * @return self
	 */
	protected function setEntity($entity) 
	{
		if(!$entity instanceof static::$self) throw new Exception(Exception::INVALID_ENTITY . ' | the entity must be an instance of ' .  get_class(static::$self) . ' | given entity: ' . var_export($entity, 1));

		$this->entity = $entity;		

		return static::$self;		
	}		


	/**
	 * Validate action
	 *
	 * if the given input is instance of self model, without spacial inputs, 
	 * so there is nothing to validate, the validation will be skipped 
	 * 
	 * @return bool
	 */	
	public function validate() 
	{
		$method = 'validate' . $this->method;

		$rules = $this->{$method}();
		
		if(!$this->entity) 
		{
			$this->validator = Validator::make($this->input, $rules);	
		
			if($this->validator->fails()) 
			{
				$this->response['validation_errors'][] = $this->validator->errors();
	
				return false;
			}	
		}

		return true;
	}
	

	/**
	 * Execute action
	 * 
	 * @return self
	 */		
	public function execute() 
	{
		$this->input = (object) $this->input; 
		
		$this->{$this->method}($this->entity); // if the act not requires entity, it shoudln't be set & will pass null which will be ignored  

		return static::$self;		
	}
	

	// /**
	//  * Get treated entity
	//  * 
	//  * Return the given entity to perform an act on or find the entity using given id
	//  * 
	//  * @return Illuminate\Database\Eloquent\Model
	//  */
	// protected function entity() 
	// {
	// 	return $this->entity ?? (isset($this->input->id) ? $this->find($this->input->id) : null) ;		
	// }


	/**
	 * Response action's resulta
	 * 
	 * @return array
	 */			
	public function response() 
	{
		return [
			'messages' => $this->messages,
			'affected' => $this->affected
		];
	}		
}

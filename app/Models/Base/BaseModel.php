<?php

namespace App\Models\Base;

use Log, Validator;
use App\Exceptions\ModelException as Exception;
use Illuminate\Database\Eloquent\Model as CoreModel;
use App\Models\Base\Traits\Singelton;

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
	 * Called act
	 * 
	 * @var string
	 */
	protected $act;	


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
	 * Perform model's act flow 
	 * 
	 * @see App\Models\Base\IModel
	 * @param string $act
	 * @param mixed $input
	 * @throws \Exception
	 * @return void
	 */	
    public static function perform($act, $input=[])
	{		
		try 
		{
			static::init($act, $input);

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
	 * @param string $act
	 * @param mixed $input
	 * @return bool
	 */
	public static function init($act, $input) 
	{
		$class = get_called_class();
				
		static::self($class)->setMethod($act)->setInput($input);
		
		return true;
	}


	/**
	 * Set method
	 * 
	 * @param string $act
	 * @return void
	 */
	protected function setMethod($act) 
	{
		if(!method_exists(static::$self, $act)) throw new Exception(Exception::INVALID_METHOD . ' | called method: '. $act);

		$this->act = $act;

		return static::$self;
	}


	/**
	 * Set input
	 * 
	 * the input can be array or eloquent model instance
	 * 
	 * e.g :
	 * Model::perform('activate', ['id' => $id])
	 * Model::perform('activate', $Model)
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
		if(!$this->entity) 
		{
			$method = 'validate' . $this->act;

			$rules = $this->{$method}();

			if(!empty($rules)) 
			{
				$this->validator = Validator::make($this->input, $rules);	
		
				if($this->validator->fails()) 
				{
					$this->response['validation_errors'][] = $this->validator->errors();
		
					return false;
				}	
			}
		}

		return true;
	}
	

	/**
	 * Execute act
	 * Handle optional inputs cases
	 * 
	 * @return self
	 */		
	public function execute() 
	{
		// execute general act without input & without entity - e.g : publishAll()
		if(!$this->entity && !$this->input) 
		{
			$this->{$this->act}();  
		}	

		// execute general act with input & without entity - e.g : storeBatch($categories)
		if(!$this->entity && $this->input) 
		{
			$this->{$this->act}($this->input);  
		}				

		// execute custom act on entity, without input - e.g: activate($entity), publish($entity)
		if($this->entity && !$this->input) 
		{
			$this->{$this->act}($this->entity);
		}

		// execute update act on entity, with input - e.g: update($entity, $updates) 
		if($this->entity && $this->input) 
		{
			$this->{$this->act}($this->entity, $this->input);  
		}	

		return static::$self;		
	}
	

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

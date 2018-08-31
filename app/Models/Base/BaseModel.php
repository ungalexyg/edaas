<?php

namespace App\Models\Base;

use Log;
use Validator;
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
	 * @var mixed
	 */
	protected $input;


	/**
	 * Act validator instance
	 * 
	 * @var Validator
	 */
	protected $validator;
	

	/**
	 * Response bag
	 * 
	 * @var array
	 */
	protected $response;


	/**
	 * Generic methods prefixes
	 */
	const ACT = 'act';
	const VALIDATE = 'validate';
	

	/**
	 * Handle model's acts flow calls
	 * 
	 * The method name will trigger the model to perform an act flow process,
	 * which includes input parsing, validation, execution & response.
	 * 
	 * e.g :
	 * Model::activate($id) will initiate 
	 * static::self($class)->setAct($act)->setInput($input)->validate()->execute()->response(); 
	 * which trigger generic methods: validateActivate() & actActivate()     
	 * 
	 * @param string $method
	 * @param mixed $input
	 * @throws Exception
	 * @return void
	 */	
    public static function __callStatic($method, $input)
	{
		$input = $input[0];
		
		// act flow exist, perform it
		if(static::init($method, $input)) 
		{
			try 
			{
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

		} // else { other native static method with non-act flow called, ignore ot optional log}										
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
				
		if(!method_exists($class, static::ACT . ucwords($method))) 
		{
			return false;	
		}
		
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
		$this->method = $method;

		return static::$self;
	}


	/**
	 * Set input
	 * 
	 * @param array $input
	 * @return void
	 */	
	protected function setInput($input) 
	{
		$this->input = $input;

		return static::$self;		
	}	

	
	/**
	 * Validate action
	 * 
	 * @return bool
	 */	
	public function validate() 
	{
		$method = static::VALIDATE . $this->method;

		$rules = $this->{$method}();
		
		$this->validator = Validator::make($this->input, $rules);	
		
		if($this->validator->fails()) 
		{
			$this->response['validation_errors'][] = $this->validator->errors();

			return false;
		}

		return true;
	}
	

	/**
	 * Excute action
	 * 
	 * @return self
	 */		
	public function execute() 
	{
		$this->input = (object) $this->input; 
		
		$method = static::ACT . $this->method;

		$this->{$method}();

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
			'messages' => $this->response
		];
	}	
}

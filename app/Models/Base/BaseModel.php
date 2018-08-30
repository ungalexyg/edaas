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
	 * Action to perform
	 * 
	 * @var string
	 */
	protected $act;
	
	
	/**
	 * Action input
	 * 
	 * @var array
	 */
	protected $input = [];


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
	 * Perform operation
	 * 
	 * @param string $act
	 * @param array $input
	 * @return void
	 */	
    public static function perform($act, $input=[])
	{
		try 
		{
			$valid = static::self()->setAct($act)->setInput($input)->validate();
			
			if($valid) 
			{
				static::$self->execute();//->response();
			}
			
			return static::$self->response;
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
	 * Set act
	 * 
	 * @param string $act
	 * @return void
	 */
	protected function setAct($act) 
	{
		$this->act = ucwords($act);
		
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
		$method = 'validate' . $this->act;

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

		$this->{$this->act}();

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

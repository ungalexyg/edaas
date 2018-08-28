<?php 

namespace App\Acts\Traits;

use App\Acts\Base\IAct;
use App\Enums\ActEnum;
use App\Exceptions\Acts\ActException as Exception;


/**
 * Has Act Trait 
 * 
 * Embed Act instance to the using class
 */ 
trait ActSetter 
{
	/**
	 * Act key
	 * 
	 * @var null|string
	 */
	protected $key;


	/**
	 * Act params
	 * 
	 * @var array
	 */
	protected $params = [];
		

	/**
	 * Act message
	 * 
	 * @var null|string
	 */
	protected $message;
	

	/**
	 * Act model
	 * 
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $model;

	
	/**
	 * Set act key
	 * 
	 * @param string $act App\Enums\Contracts\IActEnum::$act 
	 * @throws ActException
	 * @return self
	 */
	public function setKey(&$key) 
	{
		if(!in_array($key, ActEnum::getConstants())) throw new Exception(Exception::UNDEFINED_ACT_KEY);

		$this->key = $key;
		
		return $this;
	}


	/**
	 * Set act key
	 * 
	 * @param array
	 * @return self
	 */
	public function setParams(&$params=[]) 
	{
		$this->params = $params;

		return $this;
	}
	
	
	/**
	 * Load model act 
	 * 
	 * @param string $model // model calss name
	 * @throws ActException
	 * @return self
	 */
	public function loadModel($model) 
	{
		$class = ($this->model_namespace ?? 'App\Models\\') . $model;

		$this->model = new $class();

		if (!is_subclass_of($this->model, 'Illuminate\Database\Eloquent\Model')) throw new Exception(Exception::INVALID_MODEL);

		return $this;
	}	
}
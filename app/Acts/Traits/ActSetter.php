<?php 

namespace App\Acts\Traits;

use App\Acts\Base\IAct;
use App\Enums\ActEnum;
use App\Exceptions\Acts\ActException as Exception;
use App\Lib\Helpers\LaraHelpers as Lara;

/**
 * Has Act Trait 
 * 
 * Embed Act instance to the using class
 */ 
trait ActSetter 
{
	/**
	 * Act input
	 * 
	 * @var array
	 */
	protected $input = [];
		

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
	 * Set act input
	 * 
	 * @param array
	 * @return self
	 */
	public function setInput(&$input=[]) 
	{
		$this->input = $input;

		return $this;
	}
	
	
	/**
	 * Set act model
	 * 
	 * @param Illuminate\Database\Eloquent\Model
	 * @return self
	 */
	public function setModel(&$model) 
	{
		if(!Lara::isEloquent($model)) throw new Exception(Exception::INVALID_MODEL . ' | model:' . $model);

		$this->model = $model;
		
		return $this;
	}
}
<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model as CoreModel;


/**
 * Base Model
 */
interface IModel
{
	/**
	 * Initiate model instance
	 * 
	 * @param string $method
	 * @param mixed $input
	 * @return bool
	 */
	public static function init($method, $input); 
	

	/**
	 * Get self singelton instance 
	 * 
	 * @param null|string $class
	 * @return object static::$self
	 */
	public static function self($class=null); 


	/**
	 * Validate action
	 * 
	 * @return void
	 */	
	public function validate();
	

	/**
	 * Excute action
	 * 
	 * @return void
	 */		
	public function execute();
	

	/**
	 * Response action's results 
	 * 
	 * @return void
	 */			
	public function response();
}

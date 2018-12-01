<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model as CoreModel;


/**
 * Base Model
 */
interface IModel
{
	/**
	 * Perform model's act flow 
	 * 
	 * The method perform full act flow process,
	 * which includes input parsing, validation, execution & response.
	 * 
	 * The input can be array or eloquent model instance when performing action on specific instance
	 * e.g :
	 * array when perform general action : 
	 * Model::perform('customAct', ['key' => $value]) 
	 * Model::perform('activate', $model)
	 * 
	 * Regular usage of act methods is also allowed, e.g :
	 * Model::activate($StorageCategory);
	 * However, it won't perform the full flow  
	 * 
	 * @param string $method
	 * @param mixed $input
	 * @throws \Exception
	 * @return void
	 */	
    public static function perform($method, $input=[]);


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

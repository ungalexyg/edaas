<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model as CoreModel;


/**
 * Base Model
 */
interface IModel
{
	/**
	 * Perform operation
	 * 
	 * @param string $action
	 * @param array $input
	 * @return void
	 */
	public static function perform($action, $input=[]);
	

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
	 * Response action's resulta
	 * 
	 * @return void
	 */			
	public function response();
}

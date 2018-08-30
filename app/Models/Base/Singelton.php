<?php

namespace App\Models\Base;


/**
 * Singelton Trait
 */
trait Singelton
{
	/**
	 * Self instance
	 */
	protected static $self;


	/**
	 * self class name
	 * 
	 * @var array
	 */
	protected $name;
	

	/**
	 * Get self singelton instance 
	 */
	protected static function self() 
	{
		if(!static::$self) 
		{
			$class = get_called_class();
		
			static::$self = new $class();

			$parts = explode('\\', $class);

			static::$self->name = end($parts); // set reference name			
		}

		return static::$self;
	}
}

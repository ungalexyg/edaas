<?php

namespace App\Models\Base\Traits;


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
	 * 
	 * @param null|string $class
	 * @return object static::$self
	 */
	public static function self($class=null) 
	{
		if(!static::$self) 
		{
			$class = $class ?? get_called_class();
		
			static::$self = new $class();

			$parts = explode('\\', $class);

			static::$self->name = end($parts); // set reference name			
		}

		return static::$self;
	}
}

<?php 

namespace App\Processes\Processors\Traits;

use App\Exceptions\Processors\BaseProcessorException as Exception;


/**
 * Has Adapter Trait 
 * 
 * Embed Adapter instance to the using class
 */ 
trait HasAdapter 
{
	/**
	 * Adapter instance
	 * 
	 * @var IAdapter
	 */
	protected $adapter;	   


	/**
	 * Load Adapter
	 * 
	 * @param string $channel
	 * @throws BaseProcessorException
	 * @return self
	 */	
	public function loadAdapter($channel) 
	{			
		$adapter = 'App\Processes\Adapters\\' . ucwords($channel) . '\\' . ucwords($channel) . ucwords($this->process) . 'Adapter';

		if (!class_exists($adapter)) throw new Exception(Exception::UNDEFINED_ADAPTER . ' | adapter : ' . $adapter);

		$this->adapter = new $adapter();		

		return $this;
	}		    
}
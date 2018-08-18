<?php 

namespace App\Processes\Traits;

use App\Exceptions\ProcessException;


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
	 * @throws ProcessException
	 * @return self
	 */	
	public function loadAdapter($channel) 
	{			
		$adapter = 'App\Processes\Adapters\\' . ucwords($channel) . '\\' . ucwords($channel) . ucwords($this->process) . 'Adapter';

		if (!class_exists($adapter))  throw new ProcessException(ProcessException::UNDEFINED_ADAPTER . ' | adapter : ' . $adapter);

		$this->adapter = new $adapter();		

		$this->adapter->setUrl();

		return $this;
	}		    

}
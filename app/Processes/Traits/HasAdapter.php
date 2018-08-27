<?php 

namespace App\Processes\Traits;

use App\Exceptions\Processors\MainProcessorException;


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
	 * @throws MainProcessorException
	 * @return self
	 */	
	public function loadAdapter($channel) 
	{			
		$adapter = 'App\Processes\Adapters\\' . ucwords($channel) . '\\' . ucwords($channel) . ucwords($this->process) . 'Adapter';

		if (!class_exists($adapter))  throw new MainProcessorException(MainProcessorException::UNDEFINED_ADAPTER . ' | adapter : ' . $adapter);

		$this->adapter = new $adapter();		

		$this->adapter->setUrl();

		return $this;
	}		    

}
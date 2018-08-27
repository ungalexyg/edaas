<?php 
 
namespace App\Processes\Traits;

use App\Exceptions\Processors\MainProcessorException;


/**
 * Has Publisher Trait 
 * 
 * Embed Publisher instance to the using class
 */ 
trait HasPublisher 
{
	/**
	 * Publisher instance
	 * 
	 * @var IPublisher
	 */
	protected $publisher;	    


	/**
	 * Load Publisher
	 * 
	 * @throws MainProcessorException
	 * @return self
	 */	
	protected function loadPublisher() 
	{			
		$publisher = 'App\Processes\Publishers\\' . ucwords($this->process) . 'Publisher';
	
		if (!class_exists($publisher))  throw new MainProcessorException(MainProcessorException::UNDEFINED_PUBLISHER);

		$this->publisher = new $publisher();		

		$this->publisher->setProcessor($this);

		return $this;
	}		    
}
<?php 

namespace App\Processes\Traits;

use App\Exceptions\ProcessException;
use App\Processes\Processors\Base\IProcessor;

/**
 * Has Process Trait 
 * 
 * Embed process related properties, utilities & referance to the processor instance in the using class
 */ 
trait HasProcess {


	/**
	 * Processor instance
	 * 
	 * @var IProcessor
	 */
	protected $processor;	   


	/**
	 * The current process
	 * 
	 * @var string
	 */
	public $process;


	/**
	 * The current channel
	 * 
	 * @var string
	 */
	public $channel;	
	

	/**
	 * Process bag
	 * 
	 * @var array
	 */
	public $bag=[];	


	/**
	 * Process config
	 * 
	 * @var array
	 */
	public $config=[];	


	/**
	 * Default common process properties 
	 * 
	 * @var array
	 */
	protected $properties = ['process', 'channel', 'bag'];


	/**
	 * Set Processor
	 * 
	 * @param IProcessor $processor
	 * @return self
	 */	
	public function setProcessor(IProcessor &$processor) 
	{			
		$this->processor = $processor;		

		return $this;
	}
	

	/**
	 * Pull common process properties from the processor
	 * 
	 * @param array $properties
	 * @return self
	 */
	public function pull($properties=[]) 
	{
		if(!($this->processor instanceof IProcessor)) throw new ProcessException(ProcessException::FAILED_PULL_INVALID_INSTANCE);

		$properties = (!empty($properties) ? $properties : $this->properties);

		$existing_properties = get_object_vars($this->processor);

		foreach($properties as $property)
		{
			if(!array_key_exists($property, $existing_properties)) throw new ProcessException(ProcessException::FAILED_PULL_INVALID_PROPERTY  . ' | property : ' . $property);

			$this->{$property} 	= &$this->processor->{$property} ?? null;
		}

		return $this;
	} 
	
	
	/**
	 * Push common process properties to the processor
	 * 
	 * @param array $properties
	 * @return self
	 */
	public function push($properties=[]) 
	{
		if(!($this->processor instanceof IProcessor)) throw new ProcessException(ProcessException::FAILED_PUSH_INVALID_INSTANCE);

		$properties = (!empty($properties) ? $properties : $this->properties);
		
		$existing_properties = get_object_vars($this);
		
		foreach($properties as $property)
		{
			if(!array_key_exists($property, $existing_properties)) throw new ProcessException(ProcessException::FAILED_PUSH_INVALID_PROPERTY . ' | property : ' . $property);

			$this->processor->{$property} = &$this->{$property} ?? null;
		}

		return $this;
	} 
	
}
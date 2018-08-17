<?php 

namespace App\Processes\Traits;

use App\Exceptions\ProcessorException;
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
		if(!($this->processor instanceof IProcessor)) throw new ProcessorException(ProcessorException::FAILED_PULL_INVALID_INSTANCE);

		$properties = (!empty($properties) ? $properties : $this->properties);

		foreach($properties as $property)
		{
			if(!isset($this->processor->{$property})) throw new ProcessorException(ProcessorException::FAILED_PULL_INVALID_PROPERTY);

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
		if(!($this->processor instanceof IProcessor)) throw new ProcessorException(ProcessorException::FAILED_PUSH_INVALID_INSTANCE);

		$properties = (!empty($properties) ? $properties : $this->properties);

		foreach($properties as $property)
		{
			if(!isset($this->{$property})) throw new ProcessorException(ProcessorException::FAILED_PUSH_INVALID_PROPERTY);

			$this->processor->{$property} = &$this->{$property} ?? null;
		}

		return $this;
	} 
			
}
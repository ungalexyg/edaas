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
	 * Pull the process properties from the processor
	 * 
	 * @return self
	 */
	public function pull() 
	{
		$this->process 	= &$this->processor->process 	?? null;
		$this->channel 	= &$this->processor->channel 	?? null;
		$this->bag 		= &$this->processor->bag 		?? null;

		return $this;
	} 
	
	
	/**
	 * Push the process properties to the processor
	 * 
	 * @return self
	 */
	public function push() 
	{
		$this->processor->process 	= &$this->process 	?? null;
		$this->processor->channel 	= &$this->channel 	?? null;
		$this->processor->bag 		= &$this->bag 	   	?? null;

		return $this;
	} 	
}
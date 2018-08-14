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
	 * Reference to take the 'process kit' properties from the processor
	 * 
	 * @return self
	 */
	public function takeKit() 
	{
		$this->process 	= &$this->processor->process 	?? null;
		$this->channel 	= &$this->processor->channel 	?? null;
		$this->bag 		= &$this->processor->bag 		?? null;

		return $this;
	} 
	
	
	/**
	 * Reference to give the 'process kit' properties to the processor
	 * 
	 * @return self
	 */
	public function giveKit() 
	{
		$this->processor->process 	= &$this->process 	?? null;
		$this->processor->channel 	= &$this->channel 	?? null;
		$this->processor->bag 		= &$this->bag 	   	?? null;

		return $this;
	} 	
}
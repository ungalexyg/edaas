<?php 

/**
 * --------------------------------------------------------------------------
 *  Base Processor 
 * --------------------------------------------------------------------------
 * 
 * Load the current processor & initiate the process 
 */ 

namespace App\Processes\Processors\Base;

use App\Lib\Enums\Channels;
use App\Lib\Enums\Processes;
use App\Processes\Traits\HasProcess;
use App\Exceptions\ProcessorException;


/**
 * Base Processor 
 */ 
class BaseProcessor  {


	/**
	 * Processes traits
	 */
	use HasProcess;


	/**
	 * Run pre process operations
	 * 
	 * @param string @process
	 * @param string|null $channel
	 */
	public function run($process, $channel=null) 
	{
		$this->setProcess($process);

		if($channel) 
		{
			$this->setChannel($channel);
		}
				
		$this->loadProcessor()->processor->process();
	}


	/**
	 * Set process
	 * 
	 * @param string Processes::$process 
	 * @throws ProcessorException
	 * @return self
	 */	
	private function setProcess($process) 
	{
		if(!in_array($process, Processes::getConstants())) throw new ProcessorException(ProcessorException::PROCESSOR_PROCESS_UNDEFINED);
		
		$this->process = $process;
		
		return $this;
	}


	/**
	 * Set channel
	 * 
	 * @param string Channels::$channel 
	 * @throws ProcessorException
	 * @return self
	 */	
	private function setChannel($channel) 
	{
		if(!in_array($channel, Channels::getConstants())) throw new ProcessorException(ProcessorException::PROCESSOR_CHANNEL_UNDEFINED);
				
		$this->channel = $channel;		

		return $this;
	}	


	/**
	 * Load Processor
	 * 
	 * @throws ProcessorException
	 * @return self
	 */	
	private function loadProcessor() 
	{			
		$processor = 'App\Processes\Processors\\' . ucwords($this->process) . 'Processor';

		if (!class_exists($processor))  throw new ProcessorException(ProcessorException::PROCESSOR_UNDEFINED);

		unset($processor->processor); // the processor using HasProcessor trait that create extra unnecessary property when used by IProcessor instance, this property removed now to avoid misunderstoods 

		$processor = new $processor();

		$this->setProcessor($processor)->push();		

		$this->processor->load();

		return $this;
	}

}




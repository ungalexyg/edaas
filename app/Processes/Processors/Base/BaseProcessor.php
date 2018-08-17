<?php 

/**
 * --------------------------------------------------------------------------
 *  Base Processor 
 * --------------------------------------------------------------------------
 * 
 * Load the current processor & initiate the process 
 */ 

namespace App\Processes\Processors\Base;

use App\Enums\Channels;
use App\Enums\Processes;
use App\Processes\Traits\HasProcess;
use App\Exceptions\ProcessException;


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
		$this
			->setProcess($process)
				->setChannel($channel)
					->setConfig()
						->loadProcessor();
				
		$this->processor->process();
	}


	/**
	 * Set process
	 * 
	 * @param string Processes::$process 
	 * @throws ProcessException
	 * @return self
	 */	
	private function setProcess($process) 
	{
		if(!in_array($process, Processes::getConstants())) throw new ProcessException(ProcessException::UNDEFINED_PROCESS);
		
		$this->process = $process;
		
		return $this;
	}


	/**
	 * Set channel
	 * 
	 * @param string Channels::$channel 
	 * @throws ProcessException
	 * @return self
	 */	
	private function setChannel($channel) 
	{
		if(!is_null($channel) && !in_array($channel, Channels::getConstants())) throw new ProcessException(ProcessException::UNDEFINED_CHANNEL);
				
		$this->channel = $channel;		

		return $this;
	}	


	/**
	 * Set process config
	 * 
	 * @return self
	 */
	private function setConfig() 
	{
		$this->config = config('processes.settings.' . $this->process) ?? [];

		return $this;
	} 


	/**
	 * Load Processor
	 * 
	 * @throws ProcessException
	 * @return self
	 */	
	private function loadProcessor() 
	{			
		$processor = 'App\Processes\Processors\\' . ucwords($this->process) . 'Processor';

		if (!class_exists($processor))  throw new ProcessException(ProcessException::UNDEFINED_PROCESSOR);

		unset($processor->processor); // the processor using HasProcess trait that create extra unnecessary property when used by IProcessor instance, this property removed now to avoid misunderstoods 

		$processor = new $processor();

		$this->setProcessor($processor)->push(['process', 'channel', 'config']);		

		$this->processor->load();

		return $this;
	}
}




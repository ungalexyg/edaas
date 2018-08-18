<?php 

/**
 * --------------------------------------------------------------------------
 *  Base Processor 
 * --------------------------------------------------------------------------
 * 
 * Load the current processor & initiate the process 
 */ 

namespace App\Processes\Processors\Base;

use App\Models\Process;
use App\Enums\Channels;
use App\Enums\Processes;
use App\Processes\Traits\HasProcess;
use App\Exceptions\Processors\ProcessException;


/**
 * Main Processor 
 */ 
final class MainProcessor implements IMainProcessor  
{

	/**
	 * Processes traits
	 */
	use HasProcess;


	/**
	 * Run pre process operations
	 * 
	 * @param string $process
	 * @param string|null $channel
	 */
	public function run($process) 
	{
		$this->setProcess($process)
				->setChannels()
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
	 * Set mature channels for process
	 * 
	 * @throws ProcessException
	 * @return self
	 */	
	private function setChannels() 
	{
		$process = Process::matureChannels($this->process)->first(); // 1st process should be single result for $this->process anyway

		if(!$process->channels) throw new ProcessException(ProcessException::MATURE_CHANNELS_NOT_FOUND);

		$this->channels = $process->channels;		

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

		$this->setProcessor($processor)->push(['process', 'channels', 'config']);		

		$this->processor->load();

		return $this;
	}


	/**
	 * Perform specific action
	 * 
	 * @param string $action
	 */
	public function action($action) 
	{
		throw new ProcessException(ProcessException::METHOD_NOT_IMPLEMENTED);
	}	
}




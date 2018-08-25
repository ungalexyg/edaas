<?php 

namespace App\Processes\Processors\Base;

use Log;
use App\Models\Process;
use App\Enums\Processes;
use App\Processes\Traits\HasProcess;
use App\Exceptions\Processors\ProcessException;


/**
 * Main Processor 
 * 
 * Load the processors & run their process 
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
	 * @return array $response
	 */
	public function run($process) 
	{
		try 
		{
			$this->setProcess($process)->setChannels()->setConfig()->loadProcessor();

			return $this->processor->process()->stamp()->response();
		}
		catch(\Exception $e) 
		{
			return [
				'exception' => get_class($e),
				'message' => $e->getMessage()
			];
		}
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

		if(!$process->channels->count()) 
		{
			Log::channel(Log::MAIN_PROCESSOR)->info(ProcessException::MATURE_CHANNELS_NOT_FOUND, ['in' => __METHOD__ .':'.__LINE__]);
			
			throw new ProcessException(ProcessException::MATURE_CHANNELS_NOT_FOUND);
		} 

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
}




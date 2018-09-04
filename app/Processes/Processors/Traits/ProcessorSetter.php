<?php 

namespace App\Processes\Processors\Traits;

use App\Models\Process\Process;
use App\Exceptions\Processors\BaseProcessorException as Exception;
use App\Enums\ProcessEnum as Processes;


/**
 * Process Setter Trait 
 */ 
trait ProcessorSetter 
{
	/**
	 * The current process
	 * 
	 * @var string
	 */
	public $process;


	/**
	 * Response message
	 * 
	 * @var null|string
	 */
	public $message;


	/**
	 * The mature channels for process
	 * 
	 * @var array
	 */
	public $channels = [];	
	

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
	 * Set process
	 * 
	 * @param string Processes::$process 
	 * @throws BaseProcessorException
	 * @return self
	 */	
	public function setProcess($process) 
	{
		if(!in_array($process, Processes::getConstants())) throw new Exception(Exception::UNDEFINED_PROCESS);
		
		$this->process = $process;
		
		return $this;
	}


	/**
	 * Set mature channels for process
	 * 
	 * @throws BaseProcessorException
	 * @return self
	 */	
	public function setChannels() 
	{
		$process = Process::matureChannels($this->process)->first(); // 1st process should be single result for $this->process anyway

		if(!$process->channels->count()) 
		{
			Log::channel(Log::MAIN_PROCESSOR)->info(Exception::MATURE_CHANNELS_NOT_FOUND, ['in' => __METHOD__ .':'.__LINE__]);
			
			throw new Exception(Exception::MATURE_CHANNELS_NOT_FOUND);
		} 

		$this->channels = $process->channels;		

		return $this;
	}	


	/**
	 * Set process config
	 * 
	 * @return self
	 */
	public function setConfig() 
	{
		$this->config = config('processes.settings.' . $this->process) ?? [];

		return $this;
	} 
}
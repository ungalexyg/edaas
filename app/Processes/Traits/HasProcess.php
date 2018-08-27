<?php 

namespace App\Processes\Traits;

use App\Models\Process;
use App\Processes\Processors\Base\IProcessor;
use App\Exceptions\Processors\MainProcessorException;
use App\Enums\ProcessesEnum as Processes;

/**
 * Has Process Trait 
 * 
 * Embed process related properties, utilities & referance to the processor instance in the using class
 */ 
trait HasProcess 
{

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
	 * @throws MainProcessorException
	 * @return self
	 */	
	private function setProcess($process) 
	{
		if(!in_array($process, Processes::getConstants())) throw new MainProcessorException(MainProcessorException::UNDEFINED_PROCESS);
		
		$this->process = $process;
		
		return $this;
	}


	/**
	 * Set mature channels for process
	 * 
	 * @throws MainProcessorException
	 * @return self
	 */	
	private function setChannels() 
	{
		$process = Process::matureChannels($this->process)->first(); // 1st process should be single result for $this->process anyway

		if(!$process->channels->count()) 
		{
			Log::channel(Log::MAIN_PROCESSOR)->info(MainProcessorException::MATURE_CHANNELS_NOT_FOUND, ['in' => __METHOD__ .':'.__LINE__]);
			
			throw new MainProcessorException(MainProcessorException::MATURE_CHANNELS_NOT_FOUND);
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
}
<?php 

namespace App\Processes\Base;


/**
 * Base Processor 
 */ 
abstract class BaseProcessor implements IProcessor  
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
	public $bag = [];	


	/**
	 * Process config
	 * 
	 * @var array
	 */
	public $config = [];	


	#########################################
	# Setters
	#########################################	


	/**
	 * Set process
	 * 
	 * @param string Processes::$process 
	 * @throws BaseProcessorException
	 * @return self
	 */	
	public function setProcess($process) 
	{

		dd("METHOD_NOT_IMPLEMENTED", __METHOD__);
		

		if(!in_array($process, Processes::getConstants())) throw new Exception(Exception::UNDEFINED_PROCESS);
		
		$this->process = $process;
		
		return $this;
	}

	/**
	 * Set process config
	 * 
	 * @return self
	 */
	public function setConfig() 
	{
		dd("METHOD_NOT_IMPLEMENTED", __METHOD__);

		// $this->config = config('processes.settings.' . $this->process) ?? [];

		// return $this;
	}	


	#########################################
	# Implementation
	#########################################		


	/**
	 * Perform the process
	 * 
	 * @return self
	 */
	abstract public function process();	


	/**
	 * Update process timestamp
	 * 
	 * @return self
	 */
	public function stamp() 
	{
		dd("METHOD_NOT_IMPLEMENTED", __METHOD__);
		
		// $process = Process::with('channels')->where('key', $this->process)->first();
		
		// $processed_channels = $this->bag[$this->process] ?? [];
		
		// foreach($process->channels as $channel) 
		// {
		// 	if(array_key_exists($channel->key, $processed_channels)) 
		// 	{
		// 		$process->channels()->updateExistingPivot($channel->id, [
		// 			Column::LAST_PROCESS => date("Y-m-d H:i:s"),
		// 			Column::PROCESS_COUNT => ($channel->pivot->process_count + 1),
		// 		]);
		// 	}
		// }

		// return $this;
	}	


	/**
	 * Generate process response
	 * 
	 * @return array $response
	 */
	public function response() 
	{
		dd("METHOD_NOT_IMPLEMENTED", __METHOD__);

		// if(!$this->message) 
		// {
		// 	$this->message = ucwords($this->process).'Processor@response completed';
		// }

		// $log_channel = ($this->process ? 'processor_' . $this->process :  Log::PROCESSOR_MAIN);

		// Log::channel($log_channel)->info($this->message, ['in' => __METHOD__.':'.__LINE__]);

		// return [
		// 	'message' => $this->message,
		// 	'bag' => $this->bag
		// ];
	}		
}

<?php 

namespace App\Processes\Base;

use App\Lib\ProcessorException as Exception;


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
	protected $process;


	/**
	 * Process namespace
	 * 
	 * @var string
	 */
	protected $namespaces;


	/**
	 * Response message
	 * 
	 * @var null|string
	 */
	protected $message;


	/**
	 * Process bag
	 * 
	 * @var array
	 */
	protected $bag = [];	


	/**
	 * Construct processor
	 * 
	 * @param IProcess
	 * @return self
	 */
	public function __construct($process) 
	{
		$this->setProcess($process);

		return $this;
	}

	
	/**
	 * Set process instances
	 * 
	 * @param IProcess 
	 * @throws ProcessorException
	 * @return self
	 */	
	protected function setProcess($process) 
	{		
		if(!($process instanceof IProcess)) throw new Exception(Exception::INVALID_INSTANCE_PROCESS);
		
		if(!($process->processable instanceof IProcessable)) throw new Exception(Exception::INVALID_INSTANCE_PROCESSABLE);
		
		$this->process =& $process;
				
		$this->setProcessable($process->processable);
		
		$this->setNamespaces();

		return $this;
	}


	/**
	 * Set process namespaces
	 * 
	 * @return self
	 */
	protected function setNamespaces() 
	{
		$full_namespaces = get_called_class();

		$parts = explode('\\', $full_namespaces);

		array_splice($parts, -2);		

		$this->namespaces = implode('\\', $parts);

		return $this;
	}


	/**
	 * Set processable instance
	 * 
	 * @param IProcessable
	 * @return self
	 */
	abstract protected function setProcessable($processable);


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

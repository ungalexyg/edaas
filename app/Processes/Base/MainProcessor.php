<?php 

namespace App\Processes\Base;

use Log;
use App\Models\Process\Process;
use App\Enums\ProcessEnum as Processes;
use App\Exceptions\ProcessorException as Exception;


/**
 * Main Processor 
 * 
 * Load the processors & run their process 
 */ 
final class MainProcessor
{
	/**
	 * Processor instance
	 * 
	 * @var IProcessor
	 */
	protected $processor;	  	


	/**
	 * Run pre process operations
	 * 
	 * @param string $process_key App\Enums\ProcessEnum
	 * @return mixed
	 */
	public function run($process_key) 
	{
		try 
		{
			$this->loadProcessor($process_key);

			if($this->processor->isActive()) 
			{
				$response = $this->processor->process()->stamp()->response();
			}
			else 
			{
				$response = $this->processor->response(Exception::PROCESS_PAUSED . ' | process_key: ' . $process_key); 
			}
			
			$log_message = Log::DONE;
		}
		catch(\Exception $e) 
		{
			$response = [
				'exception' => get_class($e),
				'message' 	=> $e->getMessage(),
				'file' 		=> $e->getFile(),
				'line' 		=> $e->getLine()				
			];

			$log_message	= LOG::EXCEPTION;
		}

		Log::channel(Log::MAIN_PROCESSOR)->info($log_message , ['response' => $response, 'in' => __METHOD__ .':'.__LINE__]);

		return $response;
	}


	/**
	 * Load Processor
	 * 
	 * @param string $process_key App\Enums\ProcessEnum
	 * @throws ProcessorException
	 * @return self
	 */	
	private function loadProcessor($process_key) 
	{		
		if(!in_array($process_key, Processes::getConstants())) throw new Exception(Exception::UNDEFINED_PROCESS . ' | $process_key: ' . $process_key);
		
		$process = Process::with('processable')->where(['key' => $process_key])->first();
		
		$parts = explode('\\' , $process->processable_type);
		
		$process_type = end($parts) . 's'; // option 1, save some overhead. // $type = Illuminate\Support\Pluralizer::plural($type); // option 2, use when really needed
		
		$processable_key = ucwords($process->processable->key);

		$process_class = str_replace(' ', '', ucwords(str_replace('_', ' ', $process_key)).'Processor');

		$processor = "App\Processes\\$process_type\\$processable_key\Processors\\$process_class";

		if(!class_exists($processor))  throw new Exception(Exception::UNDEFINED_PROCESSOR . ' | processor: ' . $processor);

		$this->processor = new $processor($process);

		if(!($this->processor instanceof IProcessor)) throw new Exception(Exception::INVALID_INSTANCE_PROCESSOR);

		return $this;
	}	
}

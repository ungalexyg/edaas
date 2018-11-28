<?php 

namespace App\Processes\Base;

use Log;
use BaseProcessorException as Exception;


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
	 * @param string $process
	 * @param string|null $channel
	 * @return array $response
	 */
	public function run($channel, $process) 
	{
		try 
		{
			$this->loadProcessor($process);

			return $this->processor->process()->stamp()->response();
		}
		catch(\Exception $e) 
		{
			return [
				'exception' => get_class($e),
				'message' 	=> $e->getMessage(),
				'file' 		=> $e->getFile(),
				'line' 		=> $e->getLine()				
			];
		}
	}


	/**
	 * Load Processor
	 * 
	 * @throws MainProcessorException
	 * @return self
	 */	
	private function loadProcessor($process) 
	{			
		$processor = 'App\Processes\Processors\\' . ucwords($process) . 'Processor';

		if (!class_exists($processor))  throw new Exception(Exception::UNDEFINED_PROCESSOR);

		unset($processor->processor); // the processor using HasProcess trait that create extra unnecessary property when used by IProcessor instance, this property removed now to avoid misunderstoods 

		$processor = new $processor();

		if(!($processor instanceof IProcessor)) throw new Exception(Exception::INVALID_PROCESSOR);

		$this->processor = $processor->setProcess($process)->setChannels()->setConfig();

		return $this;
	}	
}




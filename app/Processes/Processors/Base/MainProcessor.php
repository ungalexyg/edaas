<?php 

namespace App\Processes\Processors\Base;

use Log;
use App\Exceptions\Processors\MainProcessorException;


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
	public function run($process) 
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
				'message' => $e->getMessage()
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

		if (!class_exists($processor))  throw new MainProcessorException(MainProcessorException::UNDEFINED_PROCESSOR);

		unset($processor->processor); // the processor using HasProcess trait that create extra unnecessary property when used by IProcessor instance, this property removed now to avoid misunderstoods 

		$processor = new $processor();

		if(!($processor instanceof IProcessor)) throw new MainProcessorException(MainProcessorException::INVALID_PROCESSOR);

		$this->processor = $processor->setProcess($processor)->setChannels()->setConfig();

		return $this;
	}	
}




<?php 
/**
 * --------------------------------------------------------------------------
 *  Processor 
 * --------------------------------------------------------------------------
 * 
 * Set process entities and perform process operations
 */ 

namespace App\Processes\Base;
use App\Lib\Enums\Channel;
use App\Lib\Enums\Process;
use App\Exceptions\ProcessorException;



/**
 * Processor 
 */ 
class Processor  {


	/**
	 * The current process
	 * 
	 * @var string
	 */
	private $process;


	/**
	 * The current channel
	 * 
	 * @var string
	 */
	private $channel;	
	

	/**
	 * Scanner instance
	 * 
	 * @var IScanner
	 */
	private $scanner;	


	/**
	 * Keepr instance
	 * 
	 * @var IKeeper
	 */
	private $keeper;	


	/**
	 * Watcher instance
	 * 
	 * @var IWatcher
	 */
	private $watcher;	


	/**
	 * Process construct
	 * 
	 * @param string $process
	 * @param string $channel
	 * @return self
	 */
	public function __construct($process=null, $channel=null) 
	{
		if($process && $channel) 
		{
			return $this->load($process, $channel);
		}

		return $this;
	} 


	/**
	 * Load Process
	 * 
	 * @param string $process
	 * @param string $channel
	 * @throws ProcessorException
	 * @return self
	 */	
	private function load($process, $channel) 
	{	
		

		return $this
					->setProcess($process)
						->setChannel($channel)
							->confirm()
								->setScanner()
									->setKeeper()
										->setWatcher();		
	}		



	/**
	 * Set process
	 * 
	 * @param string $process
	 * @return self
	 */	
	private function setProcess($process) 
	{
		if(!in_array($process, Process::getConstants())) throw new ProcessorException(ProcessorException::PROCESSOR_PROCESS_UNDEFINED);
			
		$this->process = $process;
		
		return $this;
	}


	/**
	 * Set channel
	 * 
	 * @param string $channel
	 * @return self
	 */	
	private function setChannel($channel) 
	{
		if(!in_array($channel, Channel::getConstants())) throw new ProcessorException(ProcessorException::PROCESSOR_CHANNEL_UNDEFINED);
				
		$this->channel = $channel;		

		return $this;
	}	


	/**
	 * Confirm process channel setup
	 * 
	 * @return self
	 */
	private function confirm() 
	{
		// many to many check  if process allowed in channel
		return $this;
	}	



	/**
	 * Set Scanner
	 * 
	 * @throws ProcessorException
	 * @return self
	 */	
	private function setScanner() 
	{	
		$class = 'App\Processes\\Scanners\\' . ucwords($this->process) . 'Scanner';

		if (!class_exists($class))  throw new ProcessorException(ProcessorException::PROCESSOR_SCANNER_UNDEFINED);

		$this->scanner = new $class();

		return $this;
	}			


	/**
	 * Set Keeper
	 * 
	 * @throws ProcessorException
	 * @return self
	 */	
	private function setKeeper() 
	{			
		$class = 'App\Processes\\Keepers\\' . ucwords($this->process) . 'Keeper';

		if (!class_exists($class))  throw new ProcessorException(ProcessorException::PROCESSOR_KEEPER_UNDEFINED);

		$this->keeper = new $class();		

		return $this;
	}			


	/**
	 * Set Watcher
	 * 
	 * @throws ProcessorException
	 * @return self
	 */	
	private function setWatcher() 
	{			
		$class = 'App\Processes\\Watchers\\' . ucwords($this->process) . 'Watcher';
		
		if (!class_exists($class))  throw new ProcessorException(ProcessorException::PROCESSOR_WATCHER_UNDEFINED);

		$this->watcher = new $class();	
		
		return $this;		
	}		


	public function process() 
	{			
		$this->scanner->start();
		$this->keeper->start();
		$this->watcher->start();	
		
		//dd($this->bag);

	}	


	// /**
	//  * Get Scanner
	//  */
	// protected function scanner() 
	// {
	// 	return $this->scanner;
	// }

	// /**
	//  * Get Keeper
	//  */
	// protected function keeper() 
	// {	
	// 	return $this->keeper;
	// }		


	// /**
	//  * Get Watcher
	//  */
	// protected function watcher() 
	// {
	// 	return $this->watcher;
	// }	




}




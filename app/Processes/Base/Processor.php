<?php 
/**
 * --------------------------------------------------------------------------
 *  Processor 
 * --------------------------------------------------------------------------
 * 
 * Set process entities and perform process operations
 */ 

/**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 * TODO: lazy load - load processes types during the flow if they needed
 * 	
 * scanner > keeper > watcher
 */
namespace App\Processes\Base;
use App\Lib\Enums\Channel;
use App\Lib\Enums\Process;
use App\Exceptions\ProcessorException;
use App\Processes\Base\Traits\HasScanner;
use App\Processes\Base\Traits\HasKeeper;
use App\Processes\Base\Traits\HasWatcher;
use App\Processes\Base\Traits\HasProcessKit;


/**
 * Processor 
 */ 
class Processor implements IProcessor {


	/**
	 * Processes traits
	 */
	use HasScanner, HasKeeper, HasWatcher, HasProcessKit;



	/**
	 * Run process operation
	 * 
	 * The process will run on each assigned channel
	 * with managed scheduale 
	 * 
	 * @param string @process
	 * @param string|null $channel
	 */
	public function run($process, $channel=null) 
	{
		$this->setProcess($process)->load();

		$this->scanner->takeKit($this)->process()->giveKit($this->scanner);
		$this->keeper->process()->giveKit($this->watcher);
		$this->watcher->process()->giveKit($this);

		echo '<pre>'; print_r($this->bag);
	}


	/**
	 * Load Process
	 * 
	 * @return self
	 */	
	private function load() 
	{	
		return $this->loadScanner()->loadKeeper()->loadWatcher(); 
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


	// /**
	//  * Set channel
	//  * 
	//  * @param string $channel
	//  * @return self
	//  */	
	// private function setChannel($channel) 
	// {
	// 	if(!in_array($channel, Channel::getConstants())) throw new ProcessorException(ProcessorException::PROCESSOR_CHANNEL_UNDEFINED);
				
	// 	$this->channel = $channel;		

	// 	return $this;
	// }	

}




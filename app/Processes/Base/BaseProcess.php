<?php 
/**
 * --------------------------------------------------------------------------
 *  Base Process 
 * --------------------------------------------------------------------------
 * 
 * The base of all process types bases.
 * Setting global properties to activiate the relevant process. 
 */ 

namespace App\Processes\Base;
use App\Lib\Enums\Process;
use App\Exceptions\ProcessException;

/**
 * Base Process 
 */ 
abstract class BaseProcess implements IProcess {


	/**
	 * The current process
	 * 
	 * @var string
	 */
	protected $process;


	/**
	 * Scanner instance
	 * 
	 * @var BaseScanner
	 */
	protected $scanner;	


	/**
	 * Keepr instance
	 * 
	 * @var BaseKeeper
	 */
	protected $keeper;	


	/**
	 * Watcher instance
	 * 
	 * @var BaseWatcher
	 */
	protected $watcher;	


	/**
	 * Process bag
	 * 
	 * @var array
	 */
	protected $bag=[];


	/**
	 * Process construct
	 * 
	 * @param string $process
	 * @return self
	 */
	public function __construct($process) 
	{
		return $this->setProcess($process);
	} 


	/**
	 * Set Process
	 * 
	 * @param string $process
	 * @throws ProcessException
	 * @return self
	 */	
	protected function setProcess($process) 
	{	
		if(!in_array($process, Process::getConstants())) throw new ProcessException(ProcessException::PROCESS_UNDEFINED);
		
		$this->process = $process;

		return $this->setScanner()->setKeeper()->setWatcher();
	}		


	/**
	 * Set Scanner
	 * 
	 * @throws ProcessException
	 * @return self
	 */	
	protected function setScanner() 
	{	
		$class = 'App\Processes\\Scanners\\' . ucwords($this->process) . 'Scanner';

		if (!class_exists($class))  throw new ProcessException(ProcessException::PROCESS_SCANNER_UNDEFINED);

		$this->scanner = new $class();

		return $this;
	}			


	/**
	 * Set Keeper
	 * 
	 * @throws ProcessException
	 * @return self
	 */	
	protected function setKeeper() 
	{			
		$class = 'App\Processes\\Keeprs\\' . ucwords($this->process) . 'Keepr';

		if (!class_exists($class))  throw new ProcessException(ProcessException::PROCESS_KEEPR_UNDEFINED);

		$this->keeper = new $class();		

		return $this;
	}			


	/**
	 * Set Watcher
	 * 
	 * @throws ProcessException
	 * @return self
	 */	
	protected function setWatcher() 
	{			
		$class = 'App\Processes\\Watchers\\' . ucwords($this->process) . 'Watcher';

		if (!class_exists($class))  throw new ProcessException(ProcessException::PROCESS_WTAHCER_UNDEFINED);

		$this->keeper = new $class();	
		
		return $this;		
	}		


	/**
	 * Start a process
	 * 
	 * @return mixed
	 */
	public function start() 
	{

		return $this;
	}


	/**
	 * Stop a process
	 * 
	 * @return mixed
	 */	
	public function stop() 
	{

		return $this;
	}


}




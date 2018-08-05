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
use App\Processes\Scanners\IScanner;
use App\Processes\Keepers\IKeeper;
use App\Processes\Watchers\IWatcher;


/**
 * Base Process 
 */ 
class BaseProcess implements IProcess {


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
	public function __construct($process=null) 
	{
		if($process) 
		{
			return $this->setProcess($process);
		}

		return $this;
	} 


	/**
	 * Set Process
	 * 
	 * @param string $process
	 * @throws ProcessException
	 * @return self
	 */	
	public function setProcess($process) 
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
	private function setScanner() 
	{	
		$class = 'App\Processes\\Scanners\\' . ucwords($this->process) . 'Scanner';

		if (!class_exists($class))  throw new ProcessException(ProcessException::PROCESS_UNDEFINED_SCANNER);

		$this->scanner = new $class();

		return $this;
	}			


	/**
	 * Set Keeper
	 * 
	 * @throws ProcessException
	 * @return self
	 */	
	private function setKeeper() 
	{			
		$class = 'App\Processes\\Keepers\\' . ucwords($this->process) . 'Keeper';

		if (!class_exists($class))  throw new ProcessException(ProcessException::PROCESS_UNDEFINED_KEEPER);

		$this->keeper = new $class();		

		return $this;
	}			


	/**
	 * Set Watcher
	 * 
	 * @throws ProcessException
	 * @return self
	 */	
	private function setWatcher() 
	{			
		$class = 'App\Processes\\Watchers\\' . ucwords($this->process) . 'Watcher';
		
		if (!class_exists($class))  throw new ProcessException(ProcessException::PROCESS_UNDEFINED_WATCHER);

		$this->watcher = new $class();	
		
		return $this;		
	}		


	/**
	 * Get scanner
	 */
	public function scanner() 
	{
		return $this->scanner;
	}

	/**
	 * Get scanner
	 */
	public function keeper() 
	{
		return $this->keeper;
	}		


	/**
	 * Get scanner
	 */
	public function watcher() 
	{
		return $this->watcher;
	}	


	/**
	 * Start a process
	 * 
	 * @return mixed
	 */
	public function start() 
	{
		throw new ProcessException(ProcessException::PROCESS_UNDEFINED_START);
	}


	/**
	 * Stop a process
	 * 
	 * @return mixed
	 */	
	public function stop() 
	{
		throw new ProcessException(ProcessException::PROCESS_UNDEFINED_STOP);
	}

}




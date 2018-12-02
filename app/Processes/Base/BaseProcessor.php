<?php 

namespace App\Processes\Base;

use Log;
use App\Exceptions\ProcessorException as Exception;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Enums\CollectionEnum as Collection;


/**
 * Base Processor 
 */ 
abstract class BaseProcessor implements IProcessor  
{
	/**
	 * The current process instance
	 * 
	 * @var IProcess 
	 */
	protected $process;


	/**
	 * Process config
	 * 
	 * @var array|null
	 */
	protected $config;


	/**
	 * Process log instance
	 * 
	 * @var Log 
	 */
	protected $log;


	/**
	 * Reference to process's exception class 
	 * 
	 * @var Exception
	 */
	protected $exception;	


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
	public function __construct(IProcess $process) 
	{
		$this
			->setProcess($process)
			->setConfig()
			->setLog()
			->setException(Exception::class)
			->setSpecifics();

		return $this;
	}

	
	/**
	 * Set process instances
	 * 
	 * @param IProcess 
	 * @throws ProcessorException
	 * @return self
	 */	
	protected function setProcess(IProcess $process) 
	{		
		// ensure proper instances 
		if(!($process instanceof IProcess)) throw new Exception(Exception::INVALID_INSTANCE_PROCESS);
		
		if(!($process->processable instanceof IProcessable)) throw new Exception(Exception::INVALID_INSTANCE_PROCESSABLE);
		
		$this->process =& $process;
				
		return $this;
	}
	

	/**
	 * Set process config
	 * 
	 * @return self
	 */
	protected function setConfig() 
	{
		$this->config = config('processes.settings.' . $this->process->key) ?? [];

		return $this;	
	}


	/**
	 * Set log instance
	 * 
	 * @return self
	 */
	protected function setLog() 
	{
		$this->log = new Log;
		
		$this->log->logger = $this->log::channel($this->process->key);

		$this->logger =& $this->log->logger; // for convenience

		return $this;		
	}


	/**
	 * Set exception class 
	 * 
	 * @param string $exception // exception namesapce, not the initiated instance, so it can be throwen
	 * @return self
	 */
	protected function setException($exception) 
	{
		$this->exception = $exception; 

		return $this;
	}


	/**
	 * Set process's specific properties
	 * 
	 * @return self
	 */
	abstract protected function setSpecifics();


	/**
	 * Perform the process
	 * 
	 * @return self
	 */
	abstract public function process();	


	/**
	 * Update process timestamp & count
	 * 
	 * @return self
	 */
	public function stamp() 
	{
		$this->process->process_last = date("Y-m-d H:i:s");
		$this->process->process_count++;
		$this->process->save();

		return $this;
	}	


	/**
	 * Generate process response
	 * 
	 * @param string|false $message
	 * @return array $response
	 */
	public function response($message=false) 
	{
		if(!$this->message && !$message) 
		{
			$this->message = $this->log::DONE;
		}
		
		$response = [
			'process' => $this->process->key ?? 0,
			'message' => ($message ? $message : $this->message),
		];		

		if(isset($this->config['store_bag']) && $this->config['store_bag']) 
		{
			//TODO: store this as backup during dev/pilot in /storage/processes/{process}/date-bag.json
			// Storage::disk('processes')...
			$response['bag'] = $this->bag; 
		}

		return $response;
	}	
	

	####################################
	# Helpers
	####################################


	/**
	 * Get process namespaces
	 * 
	 * @return string $namespaces
	 */
	protected function getNamespaces() 
	{
		$full_namespaces = get_called_class();

		$parts = explode('\\', $full_namespaces);

		array_splice($parts, -2);		

		$namespaces = implode('\\', $parts);

		return $namespaces;
	}	


	/**
	 * Check if the initiated process is active or paused
	 * 
	 * @return bool
	 */
	public function isActive() 
	{
		if(isset($this->process)) 
		{
			return $this->process->process_status ? true : false;
		}

		return false;
	}		
}

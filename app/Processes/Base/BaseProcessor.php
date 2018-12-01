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
		$this->setProcess($process);

		if($this->process->process_status == Collection::PROCESS_PAUSED) 
		{		
			throw new Exception(Exception::PROCESS_PAUSED . ' | process_key: ' . $this->process->key);
		}		

		$this
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
	 * Update process timestamp
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
	 * @return array $response
	 */
	public function response() 
	{
		if(!$this->message) 
		{
			$this->message = $this->log::DONE;
		}

		return [
			'message' => $this->message,
			'bag' => $this->bag
		];		
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
}

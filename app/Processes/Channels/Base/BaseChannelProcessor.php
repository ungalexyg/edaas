<?php 

namespace App\Processes\Channels\Base;

use Log;
use App\Models\Process\Process;
use App\Enums\DBColumnsEnum as Column;
use App\Enums\ProcessEnum as Processes;
use App\Exceptions\Processors\BaseProcessorException as Exception;

use App\Processes\Base\BaseProcessor;


/**
 * Base Channel Processor 
 */ 
abstract class BaseChannelProcessor extends BaseProcessor implements IChannelProcessor  
{
	/**
	 * The current process
	 * 
	 * @var string
	 */
	public $process;


	/**
	 * Response message
	 * 
	 * @var null|string
	 */
	public $message;


	/**
	 * The mature channels for process
	 * 
	 * @var array
	 */
	public $channels = [];	
	

	/**
	 * Process bag
	 * 
	 * @var array
	 */
	public $bag = [];	


	/**
	 * Process config
	 * 
	 * @var array
	 */
	public $config = [];	


	#########################################
	# Setters
	#########################################	


	/**
	 * Set process
	 * 
	 * @param string Processes::$process 
	 * @throws BaseProcessorException
	 * @return self
	 */	
	public function setProcess($process) 
	{
		if(!in_array($process, Processes::getConstants())) throw new Exception(Exception::UNDEFINED_PROCESS);
		
		$this->process = $process;
		
		return $this;
	}


	/**
	 * Set mature channels for process
	 * 
	 * @throws BaseProcessorException
	 * @return self
	 */	
	public function setChannels() 
	{
		$process = Process::matureChannels($this->process)->first(); // 1st process should be single result for $this->process anyway

		if(!$process->channels->count()) 
		{
			Log::channel(Log::PROCESSOR_BASE)->info(Exception::MATURE_CHANNELS_NOT_FOUND, ['in' => 'BaseProcessor@setChannels:' . __LINE__]);
			
			throw new Exception(Exception::MATURE_CHANNELS_NOT_FOUND);
		} 

		$this->channels = $process->channels;		

		return $this;
	}	


	/**
	 * Set process config
	 * 
	 * @return self
	 */
	public function setConfig() 
	{
		$this->config = config('processes.settings.' . $this->process) ?? [];

		return $this;
	}	


	#########################################
	# Implementations 
	#########################################


	/**
	 * Perform the process
	 * 
	 * @return self
	 */
	abstract public function process();	


    /**
     * Scan & fetch data from channel 
     * 
     * @return self
     */
	abstract public function scan();

    
	/**
	 * Store fresh scanned data in the storage
	 * 
	 * @return self
	 */
	abstract public function store();			


    /**
	 *  Publish data from the storage 
	 * 
	 * @return void
     */
	abstract public function publish();		


	/**
	 * Update process timestamp
	 * 
	 * @return self
	 */
	public function stamp() 
	{
		$process = Process::with('channels')->where('key', $this->process)->first();
		
		$processed_channels = $this->bag[$this->process] ?? [];
		
		foreach($process->channels as $channel) 
		{
			if(array_key_exists($channel->key, $processed_channels)) 
			{
				$process->channels()->updateExistingPivot($channel->id, [
					Column::LAST_PROCESS => date("Y-m-d H:i:s"),
					Column::PROCESS_COUNT => ($channel->pivot->process_count + 1),
				]);
			}
		}

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
			$this->message = ucwords($this->process).'Processor@response completed';
		}

		$log_channel = ($this->process ? 'processor_' . $this->process :  Log::PROCESSOR_MAIN);

		Log::channel($log_channel)->info($this->message, ['in' => __METHOD__.':'.__LINE__]);

		return [
			'message' => $this->message,
			'bag' => $this->bag
		];
	}		
}




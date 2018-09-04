<?php 

namespace App\Processes\Processors\Base;

use Log;
use App\Models\Process\Process;
use App\Processes\Processors\Traits\ProcessorSetter;


/**
 * Base Processor 
 */ 
abstract class BaseProcessor implements IProcessor  
{
	/**
	 * Processes traits
	 */
	use ProcessorSetter;


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
					Process::LAST_PROCESS => date("Y-m-d H:i:s"),
					Process::PROCESS_COUNT => ($channel->pivot->process_count + 1),
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
			$this->message = ucwords($this->process).'Processor completed with ' . (!empty($this->bag) ? 'full bag :)': 'empty bag :/');
		}

		$log_channel = ( $this->process ? 'processor_' . $this->process :  Log::PROCESSOR_MAIN);

		Log::channel($log_channel)->info($this->message, ['in' => 'BaseProcessor@response:'.__LINE__]);

		return [
			'message' => $this->message,
			'bag' => $this->bag
		];
	}		
}




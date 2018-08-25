<?php 

namespace App\Processes\Processors\Base;

use Log;
use App\Processes\Traits\HasKeeper;
use App\Processes\Traits\HasProcess;
use App\Processes\Traits\HasScanner;
use App\Processes\Traits\HasPublisher;
use App\Models\Process;


/**
 * Base Processor 
 */ 
abstract class BaseProcessor implements IProcessor  
{
	/**
	 * Processes traits
	 */
	use HasProcess, HasScanner, HasKeeper, HasPublisher;


	/**
	 * Load processor dependencies
	 * 
	 * @return self
	 */	
	abstract public function load();	


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
			$this->message = 'the '.$this->process.' processor completed the process with ' . (!empty($this->bag) ? 'full bag :)': 'empty bag :/');
		}

		$log_channel = ( $this->process ? $this->process . '_processor' :  Log::MAIN_PROCESSOR);

		Log::channel($log_channel)->info($this->message, ['in' => __METHOD__ .':'.__LINE__]);

		return [
			'message' => $this->message,
			'bag' => $this->bag
		];
	}		
}




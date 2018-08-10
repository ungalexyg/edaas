<?php 
/**
 * --------------------------------------------------------------------------
 *  Processor Setter 
 * --------------------------------------------------------------------------
 * 
 * Handle Processor logistics.
 */ 

namespace App\Processes\Base;

use App\Exceptions\ProcessorException;
use App\Models\Channel;
use App\Models\Process;

/**
 * Processor Setter
 */ 
class ProcessorSetter  {


	/**
	 * Set the channels foreach process
	 * 
	 * @throws 
	 * 
	 * @return true
	 */
	public function processesChannels() 
	{
		$relations = config('processes.processes_channels');

		foreach($relations as $process_key => $channels) 
		{
			// get the process
			$process = Proceess::where('key', $process_key)->firstOrFail(); 
			
			// datch all processes
			$process->channels()->deatch();
			
			foreach($channels as $channel_key) 
			{
				$channel = Proceess::where('key', $channel_key)->first(); 

				if(!$channel) 
				{
					throw new ProcessorException('Trying to assign undefined channel to process | $process_key:' . $process_key . ' | $channel_key : ' . $channel_key);
				}

				$process->channels()->attach($channel->EntryID);
			}
		}
	} 
}




<?php 

namespace App\Processes\Processors;


use Log;
use App\Processes\Traits\HasKeeper;
use App\Processes\Traits\HasProcess;
use App\Processes\Traits\HasScanner;
use App\Processes\Traits\HasPublisher;
use App\Processes\Processors\Base\IProcessor;
use App\Models\Process;

/**
 * Categories Processor 
 * 
 * Run categories processes
 */ 
class CategoriesProcessor implements IProcessor 
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
	public function load() 
	{	
		return $this->loadScanner()->loadKeeper();
	}


	/**
	 * Manage the process
	 * 
	 * @return void
	 */
	public function process() 	
	{
		$this->scanner->pull()->scan()->push();
		
		$this->keeper->pull()->store();
		
		if(($this->config['auto_publish'] ?? false)) 
		{			
			$this->keeper->push();

			$this->loadPublisher()->publisher->pull()->publish();
		}

		$this->stamp();

		Log::channel(Log::CATEGORIES_PROCESSOR)->info('categories processor completed the process', ['in' => __METHOD__ .':'.__LINE__]);

		echo '<pre><hr />'; print_r($this->bag);
	}


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
				$process->channels()->updateExistingPivot($channel->id, [Process::LAST_PROCESS => date("Y-m-d H:i:s")]);
			}
		}

		return $this;
	}
}

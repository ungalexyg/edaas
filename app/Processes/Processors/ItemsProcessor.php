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
 * Items Processor 
 * 
 * Run items processes
 */ 
class ItemsProcessor implements IProcessor 
{
	/**
	 * Processes traits
	 */
	use HasProcess, HasScanner, HasKeeper, HasPublisher;


	/**
	 * The categories for process scan
	 */
	protected $categories; 


	/**
	 * Load processor dependencies
	 * 
	 * @return self
	 */	
	public function load() 
	{	
		$this->setCategoiries();

		return $this->loadScanner()->loadKeeper();
	}


	/**
	 * Set categories to scan items from
	 */
	protected function setCategoiries() 
	{



		# select from storage_categorires where active



		//$process = Process::matureChannels($this->process)->first(); // 1st process should be single result for $this->process anyway

		// if(!$process->channels) throw new ProcessException(ProcessException::MATURE_CHANNELS_NOT_FOUND);

		// $this->channels = $process->channels;		

		// return $this;		
	}


	/**
	 * Manage the process
	 * 
	 * @return void
	 */
	public function process() 	
	{
		// $this->scanner->pull()->scan()->push();
		
		// $this->keeper->pull()->store();
		
		// if(($this->config['auto_publish'] ?? false)) 
		// {			
		// 	$this->keeper->push();

		// 	$this->loadPublisher()->publisher->pull()->publish();
		// }

		// $this->stamp();

		// Log::channel(Log::ITEMS_PROCESSOR)->info('categories processor completed the process', ['in' => __METHOD__ .':'.__LINE__]);

		// echo '<pre><hr />'; print_r($this->bag);
	}


	/**
	 * Update process timestamp
	 * 
	 * @return self
	 */
	public function stamp() 
	{
		return $this;
	}
}

<?php 

namespace App\Processes\Channels\Base\Processors;

use Log;
use App\Models\Process\Process;
use App\Processes\Base\BaseProcessor;
use App\Enums\ProcessEnum as Processes;
use App\Exceptions\ProcessorException as Exception;

    
/**
 * Base Channel Processor 
 */ 
abstract class BaseChannelProcessor extends BaseProcessor implements IChannelProcessor  
{
	/**
	 * Processable instance type  
	 * 
	 * @var IProcessable
	 */
	protected $channel;


	/**
	 * Set processable instance
	 * 
	 * @param IProcessable
	 * @return self
	 */	
	protected function setProcessable($processable) 
	{
		$this->channel =& $processable;

		return $this;
	}	


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
}




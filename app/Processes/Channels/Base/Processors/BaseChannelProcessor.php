<?php 

namespace App\Processes\Channels\Base\Processors;

use App\Models\Channel\Channel;
use App\Processes\Base\BaseProcessor;
use App\Models\Collectors\Base\ICollector;
use App\Processes\Channels\Base\Adapters\IAdapter;

    
/**
 * Base Channel Processor 
 */ 
abstract class BaseChannelProcessor extends BaseProcessor implements IChannelProcessor  
{
	/**
	 * Process channel instance 
	 * 
	 * @var Channel 
	 */
	protected $channel;
	

	/**
	 * Process collector model
	 * 
	 * @var IAdapter
	 */
	protected $adapter;


	/**
	 * Process collector model
	 * 
	 * @var ICollector
	 */
	protected $collector;


	/**
	 * Set channel instance
	 * 
	 * @param Channel
	 * @return self
	 */	
	protected function setChannel(Channel &$channel) 
	{
		$this->channel = $channel;

		return $this;
	}	


	/**
	 * Set adapter instance
	 * 
	 * @var IAdapter $adapter
	 * @return self
	 */
	protected function setAdapter(IAdapter &$adapter) 
	{
		$this->adapter = $adapter;

		return $this;
	}	


	/**
	 * Set collector instance
	 * 
	 * @var ICollector $collector
	 * @return self
	 */
	protected function setCollector(ICollector &$collector) 
	{
		$this->collector = $collector;

		return $this;
	}		

	
	/**
	 * Set process specific properties
	 * 
	 * @return self
	 */	
	abstract protected function setSpecifics();


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

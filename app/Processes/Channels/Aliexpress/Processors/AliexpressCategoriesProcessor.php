<?php 

namespace App\Processes\Channels\Aliexpress\Processors;

use App\Processes\Channels\Base\Traits\ChennelProcess;
use App\Processes\Channels\Base\Processors\BaseChannelProcessor;
use App\Models\Collectors\Aliexpress\CAliexpressCategory as Collector;
use App\Processes\Channels\Aliexpress\Adapters\AliexpressCategoriesAdapter as Adapter;
use App\Processes\Channels\Aliexpress\Exceptions\AliexpressCategoriesProcessorException as Exception;


/**
 * Aliexpress Categories Processor 
 */ 
class AliexpressCategoriesProcessor extends BaseChannelProcessor 
{	  
    /**
     * Use traits
     */
    use ChennelProcess;


	/**
	 * Set process specific properties
	 * 
	 * @return self
	 */	
	protected function setSpecifics() 
	{
        $adapter    = new Adapter;   
        $collector  = new Collector;
        $channel    =& $this->process->processable; 
        $exception  = Exception::class;     

		$this->setChannel($channel);
		$this->setAdapter($adapter);
		$this->setCollector($collector);
        $this->setException($exception); 

		return $this;
	}		
}

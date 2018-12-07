<?php

namespace App\Processes\Channels\Base\Traits;


/**
 * Chennel Process Trait, handle common channels process
 */
trait ChennelProcess
{
	/**
	 * Manage the process
	 * 
	 * @return self
	 */
	public function process() 	
	{
		$this->scan()->store();
        
        $this->logger->info($this->log::DONE, ['in' => __METHOD__ .':'.__LINE__]);

		return $this;
	}		


    /**
     * Scan & fetch data from channel 
     * 
     * @return self
     */
	public function scan() 
	{        
        $this->bag = $this->adapter->setUrl()->setSpider()->fetch();
        
        $this->logger->info((!empty($this->bag) ? $this->log::BAG_OK : $this->log::BAG_FAILED), ['in' => __METHOD__ .':'.__LINE__]);
        
        return $this;
	}

    
	/**
	 * Store fresh scanned data in the storage
     * At this stage $this->bag should have the following contents:
     *  
     *   [
     *      [
     *          "title" => "Quinceanera Dresses"
     *          "path" => "/category/200001556/quinceanera-dresses.html"
     *          "category_id" => 200001556
     *          "parent_category_id" => 100003235
     *      ],
     *      ...
     *   ]
	 * 
     * @return self
	 */
	public function store()
    {        
        $this->collector::perform('storeBatch', $this->bag);

        $this->logger->info($this->log::DONE, ['in' => __METHOD__ .':'.__LINE__]);

        return $this;
    }


    /**
	 *  Publish data from the storage 
	 * 
	 * @return void
     */
	public function publish() 
	{
        dd("METHOD_NOT_IMPLEMENTED", __METHOD__, [
            $this->process->key, 
            $this->bag
        ]);

        // StorageCategory::perform('publishAll');
        
        // // if(($this->config['auto_active'] ?? false)) 
        // // {
        // //     StorageCategory::perform('activateAll');            
        // // }

        // Log::channel(Log::PROCESSOR_CATEGORIES)->info('CategoriesProcessor@publish done!', []);        
	}	    
}
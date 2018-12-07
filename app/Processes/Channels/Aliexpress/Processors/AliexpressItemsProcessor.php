<?php 

namespace App\Processes\Channels\Aliexpress\Processors;


use App\Processes\Channels\Base\Traits\ChennelProcess;
use App\Processes\Channels\Base\Processors\BaseChannelProcessor;
use App\Models\Collectors\Aliexpress\CAliexpressItem as ItemCollector;
use App\Models\Collectors\Aliexpress\CAliexpressCategory as CategoryCollector;
use App\Processes\Channels\Aliexpress\Adapters\AliexpressItemsAdapter as Adapter;
use App\Processes\Channels\Aliexpress\Exceptions\AliexpressItemsProcessorException as Exception;


/**
 * Aliexpress Items Processor 
 */ 
class AliexpressItemsProcessor extends BaseChannelProcessor
{
    /**
     * Use traits
     */
    use ChennelProcess;


	/**
	 * Category collector instance
	 * 
	 * @var App\Models\Collectors\Aliexpress\CAliexpressCategory
	 */
	protected $categoryCollector;


	/**
	 * Items categories
	 * 
	 * @var array
	 */
	protected $categoires = [];


	/**
	 * Set process specific properties
	 * 
	 * @return self
	 */	
	protected function setSpecifics() 
	{
		$this->categoryCollector  	= new categoryCollector;
        $itemCollector  			= new ItemCollector;
        $adapter    				= new Adapter;   
        $channel    				=& $this->process->processable; 
        $exception  				= Exception::class;     
		
		$this->setChannel($channel);
		$this->setAdapter($adapter);
		$this->setCollector($itemCollector);
        $this->setException($exception); 
        $this->setCategories(); 

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
	public function process() 
	{
		dd("METHOD NOT IMPLEMENTED", __METHOD__);

		// foreach($this->channels as $channel) 
		// {
		// 	$this->setCategoiries($channel->id)->loadAdapter($channel->key);

		// 	$this->channel_key = $channel->key;

		// 	$this->scan()->store();

		// 	($this->config['auto_publish'] ?? false) ? $this->publish() : null;			
		// }

		// return $this;
	}


    /**
     * Scan & fetch data from channel 
     * 
     * @return self
     */
	public function scan() 
	{

		dd("METHOD NOT IMPLEMENTED", __METHOD__);

		// foreach($this->categories as $storageCategory) 
		// {
		// 	$this->bag[$this->process][$this->channel_key][$storageCategory->id] = $this->adapter->fetch($storageCategory);			
		// }

		// Log::channel(Log::PROCESSOR_ITEMS)->info(Log::ACTION_COMPLETED, ['in' => __METHOD__ .':'. __LINE__]);

		// return $this;
	}

    
	/**
	 * Store fresh scanned data in the storage
	 * 
     * At this stage $this->bag should have the following contents:
     *  
     * [items] => Array // process name
     *   (
     *       [aliexpress] => Array // channel key
     *           (
     *               [123] => Array // storage_category_id
     *                   ( 
	 * 						 [0] => Array // item data
	 * 							(
	 *                       		[title] => Women's Watch
     *                       		[price] => 12.13$
     *                       		[orders] => 5
	 * 							)	
	 *
     *                   )
	 * 
     * @return self
	 */
	public function store() 
	{      
		dd("METHOD NOT IMPLEMENTED", __METHOD__);

		// $items =& $this->bag[$this->process] ?? null;

        // StorageItem::perform('storeBatch', $items);

        // Log::channel(Log::PROCESSOR_ITEMS)->info(Log::ACTION_COMPLETED, ['in' => __METHOD__ .':'. __LINE__]);

        // return $this;
	}


    /**
	 * Publish data from the storage 
	 * 
	 * @return self
     */
	public function publish() 
	{
		dd("METHOD NOT IMPLEMENTED", __METHOD__);

		return $this;
	}	
	
	
	#########################################
	# Setters
	#########################################	


	/**
	 * Set categories to scan items from
	 * 
	 * @return self
	 */
	protected function setCategories() 
	{		
		$this->categories = $this->categoryCollector::awakeProcessables()->get();

		if(!$this->categories->count()) 
		{
			//TODO: log...

			dd("METHOD NOT IMPLEMENTED - continue here", __METHOD__);

			// Log::channel(Log::ALIEXPRESS_ITEMS)->info(Exception::MATURE_STORAGE_CATEGORIES_NOT_FOUND, ['in' => __METHOD__ .':'. __LINE__]);
			// $this->logger->info($this->log::DONE, ['in' => __METHOD__ .':'.__LINE__]);

			throw new Exception(Exception::MATURE_STORAGE_CATEGORIES_NOT_FOUND);
		} 

		return $this;
	}	
}

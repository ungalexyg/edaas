<?php 

namespace App\Processes\Channels\Aliexpress\Processors;


use App\Processes\Channels\Base\Traits\ChennelProcess;
use App\Processes\Channels\Base\Processors\BaseChannelProcessor;
use App\Models\Collectors\Aliexpress\CAliexpressItem as Collector;
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
	 * TODO:
	 * 
	 * 2 - get mature storage categories from mature channels
	 * 3 - process these categories
	 */
	protected function setCategoiries($channel_id) 
	{		

		dd("METHOD NOT IMPLEMENTED", __METHOD__);
		

		// $storageCategories = StorageCategory::matureStorageCategories($channel_id)->get();

		// if(!$storageCategories->count()) 
		// {
		// 	Log::channel(Log::PROCESSOR_ITEMS)->info(Exception::MATURE_STORAGE_CATEGORIES_NOT_FOUND, ['in' => __METHOD__ .':'. __LINE__]);
			
		// 	throw new Exception(Exception::MATURE_STORAGE_CATEGORIES_NOT_FOUND);
		// } 

		// $this->categories = $storageCategories;		

		// return $this;
	}	

}

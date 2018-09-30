<?php 

namespace App\Processes\Processors;

use App\Models\Process\Process;
use App\Enums\DBColumnsEnum as Column;
use App\Models\StorageCategory\StorageCategory;
use App\Processes\Processors\Base\BaseProcessor;
use App\Exceptions\Processors\ItemsProcessorException as Exception;

/**
 * Items Processor 
 * 
 * Run items processes
 * 
 * @Yalla : https://www.aliexpress.com/category/100003084/hoodies-sweatshirts.html?spm=2114.search0101.1.18.378048b6i9vvAd&g=y
 */ 
class ItemsProcessor extends BaseProcessor
{
	/**
	 * The categories for process scan
	 */
	protected $categories; 


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
		$storageCategories = StorageCategory::matureStorageCategories($channel_id);
		
		if(!$storageCategories->count()) 
		{
			Log::channel(Log::PROCESSOR_ITEMS)->info(Exception::MATURE_STORAGE_CATEGORIES_NOT_FOUND, ['in' => 'ItemsProcessor@setCategoiries:' . __LINE__]);
			
			throw new Exception(Exception::MATURE_CHANNELS_NOT_FOUND);
		} 

		$this->categories = $storageCategories;		


		//dd($this->categories);

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
		foreach($this->channels as $channel) 
		{
			$this->setCategoiries($channel->id);
		}

		return $this;
	}


    /**
     * Scan & fetch data from channel 
     * 
     * @return self
     */
	public function scan() 
	{

	}

    
	/**
	 * Store fresh scanned data in the storage
	 * 
	 * @return self
	 */
	public function store() 
	{

	}


    /**
	 *  Publish data from the storage 
	 * 
	 * @return void
     */
	public function publish() 
	{

	}		
}

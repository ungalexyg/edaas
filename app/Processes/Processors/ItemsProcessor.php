<?php 

namespace App\Processes\Processors;

use App\Processes\Processors\Base\BaseProcessor;
use App\Models\{
	Process\Process,
	StorageCategory\StorageCategory
};


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
		//StorageCategory::

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

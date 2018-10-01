<?php 

namespace App\Processes\Processors;

use Log;
use App\Models\Process\Process;
use App\Enums\DBColumnsEnum as Column;
use App\Models\StorageItem\StorageItem;
use App\Models\StorageCategory\StorageCategory;
use App\Processes\Processors\Traits\HasAdapter;
use App\Processes\Processors\Base\BaseProcessor;
use App\Exceptions\Processors\ItemsProcessorException as Exception;
//use Illuminate\Support\Facades\DB;

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
	 * Use process traits
	 */    
    use HasAdapter;


	/**
	 * The categories for process scan
	 * 
	 * @var array
	 */
	protected $categories; 

	
	/**
	 * Channel key
	 * 
	 * @var string
	 */
	protected $channel_key; 	


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
		$storageCategories = StorageCategory::matureStorageCategories($channel_id)->get();

		if(!$storageCategories->count()) 
		{
			Log::channel(Log::PROCESSOR_ITEMS)->info(Exception::MATURE_STORAGE_CATEGORIES_NOT_FOUND, ['in' => 'ItemsProcessor@setCategoiries:' . __LINE__]);
			
			throw new Exception(Exception::MATURE_STORAGE_CATEGORIES_NOT_FOUND);
		} 

		$this->categories = $storageCategories;		

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
			$this->setCategoiries($channel->id)->loadAdapter($channel->key);

			$this->channel_key = $channel->key;

			$this->scan()->store();

			// TODO: 
			//($this->config['auto_publish'] ?? false) ? $this->publish() : null;			

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
		foreach($this->categories as $storageCategory) 
		{
			$this->bag[$this->process][$this->channel_key][$storageCategory->id] = $this->adapter->fetch($storageCategory);			
		}


		dd($this->bag);

		return $this;
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
        $items = $this->bag[$this->process] ?? null;
        
        StorageItem::perform('storeBatch', $items);

        Log::channel(Log::PROCESSOR_ITEMS)->info('ItemsProcessor@store completed', []);

        return $this;
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

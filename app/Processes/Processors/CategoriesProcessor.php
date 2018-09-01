<?php 

namespace App\Processes\Processors;

use Log;
use App\Models\Channel;
use App\Models\StorageCategory;
use App\Processes\Processors\Base\BaseProcessor;
use App\Exceptions\Processors\CategoriesProcessorException;


/**
 * Categories Processor 
 * 
 * Manage categories processes
 */ 
class CategoriesProcessor extends BaseProcessor 
{	
	/**
	 * Manage the process
	 * 
	 * @return array $this->response()
	 */
	public function process() 	
	{
		$this->scan()->store();
		
		($this->config['auto_publish'] ?? false) ? $this->publish() : null;

		return $this;
	}		


    /**
     * Scan & fetch data from channel 
     * 
     * @return self
     */
	public function scan() 
	{
        foreach($this->channels as $channel) 
        {    
            $this->bag[$this->process][$channel->key] = $this->loadAdapter($channel->key)->adapter->fetch();
        }            
       
        Log::channel(Log::CATEGORIES_SCANNER)->info('scan categories completed ' . (!empty($this->bag) ? 'successfully with full bag :)' : 'with empty bag :/') , ['in' => __METHOD__ .':'.__LINE__]);

        return $this;
	}

    
	/**
	 * Store fresh scanned data in the storage
     *
     * At this stage $this->bag shouldhave the following contents:
     *  
     * [categories] => Array
     *   (
     *       [aliexpress] => Array
     *           (
     *               [0] => Array
     *                   (
     *                       [title] => Women's Clothing & Accessories
     *                       [path] => /women-clothing-accessories.html
     *                       [channel_category_id] => 100003109
     *                       [parent_channel_category_id] => 100003222
     *                   )
	 * 
	 * @see App\Observers\StorageCategoryObserver
     * @return self
	 */
	public function store()
    {
        $categories = $this->bag[$this->process] ?? null;
        
        if(!is_array($categories)) throw new CategoriesProcessorException(CategoriesProcessorException::INVALID_BAG_CONTENTS . ' | ' . print_r(['bag' => $this->bag], 1));

        foreach($categories as $channel_key => $channel_categories) 
        {
            $channel = Channel::where('key', $channel_key)->first();

            if(!isset($channel->id)) throw new CategoriesProcessorException(CategoriesProcessorException::INVALID_CHANNEL_KEY . ' | key: ' .  $channel_key);            

            foreach($channel_categories as $k => $category_data) 
            {                
                $channel_category_id = $category_data['channel_category_id'] ?? null;

                if(!is_numeric($channel_category_id)) throw new CategoriesProcessorException(CategoriesProcessorException::INVALID_CHANNEL_CATEGORY_ID . ' | channel_category_id : ' . var_export($channel_category_id, 1));

                unset($category_data['channel_category_id']); // adjustment for updateOrCreate

                $category_data['channel_id'] = $channel->id;
                                
                // if there's a StorageCategory with the given channel_category_id, set the rest of the data to the given $category_data, otherwise create it.
                StorageCategory::updateOrCreate(['channel_category_id' => $channel_category_id], $category_data);
            }
        }

        Log::channel(Log::CATEGORIES_KEEPER)->info('categories keeper completed store process', ['in' => __METHOD__ .':'.__LINE__]);

        return $this;
    }

    /**
	 *  Publish data from the storage 
	 * 
	 * @return void
     */
	public function publish() 
	{
        StorageCategory::perform('publishAll');
        
        if(($this->config['auto_active'] ?? false)) 
        {
            StorageCategory::perform('activateAll');            
        }
	}			
}

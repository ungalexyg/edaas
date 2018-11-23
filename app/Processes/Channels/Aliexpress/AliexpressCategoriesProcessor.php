<?php 

namespace App\Processes\Channels\Aliexpress;

use Log;
use App\Models\Channel\Channel;
use App\Models\StorageCategory\StorageCategory;
use App\Processes\Processors\Base\BaseProcessor;
use App\Processes\Processors\Traits\HasAdapter;
use App\Exceptions\Processors\CategoriesProcessorException as Exception;


/**
 * Aliexpress Categories Processor 
 * 
 * Manage categories processes
 */ 
class AliexpressCategoriesProcessor extends BaseProcessor 
{	
	/**
	 * Use process traits
	 */    
    use HasAdapter;

    
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
       
        Log::channel(Log::PROCESSOR_CATEGORIES)->info('CategoriesProcessor@scan completed ' . (!empty($this->bag) ? 'successfully with contents' : 'without contents') , []);

        return $this;
	}

    
	/**
	 * Store fresh scanned data in the storage
     *
     * At this stage $this->bag should have the following contents:
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
     * @return self
	 */
	public function store()
    {
        $categories = $this->bag[$this->process] ?? null;
        
        StorageCategory::perform('storeBatch', $categories);

        Log::channel(Log::PROCESSOR_CATEGORIES)->info('CategoriesProcessor@store completed', []);

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
        
        // if(($this->config['auto_active'] ?? false)) 
        // {
        //     StorageCategory::perform('activateAll');            
        // }

        Log::channel(Log::PROCESSOR_CATEGORIES)->info('CategoriesProcessor@publish done!', []);        
	}			
}

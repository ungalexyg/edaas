<?php 

namespace App\Processes\Channels\Aliexpress\Processors;

use Log;
// use App\Models\Channel\Channel;
// use App\Models\StorageCategory\StorageCategory;
use App\Processes\Channels\Base\Processors\BaseChannelProcessor;
use App\Processes\Channels\Aliexpress\Exceptions\AliexpressCategoriesProcessorException as Exception;
use App\Processes\Channels\Aliexpress\Adapters\AliexpressCategoriesAdapter as Adapter;


/**
 * Aliexpress Categories Processor 
 */ 
class AliexpressCategoriesProcessor extends BaseChannelProcessor 
{	    
	/**
	 * Manage the process
	 * 
	 * @return array $this->response()
	 */
	public function process() 	
	{
		$this->scan()->store();
        
        Log::channel(Log::ALIEXPRESS_CATEGORIES)->info(Log::DONE, ['in' => __METHOD__ .':'.__LINE__]);

		return $this;
	}		


    /**
     * Scan & fetch data from channel 
     * 
     * @return self
     */
	public function scan() 
	{
        // dd("METHOD_NOT_IMPLEMENTED", __METHOD__, [
        //     $this->process->key, 
        //     $this->namespaces, 
        //     $this->channel->key
        // ]);
        
        $this->bag = (new Adapter())->fetch();
        
        Log::channel(Log::ALIEXPRESS_CATEGORIES)->info((!empty($this->bag) ? Log::BAG_OK : Log::BAG_FAILED), ['in' => __METHOD__ .':'.__LINE__]);
        
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
        dd("METHOD_NOT_IMPLEMENTED", __METHOD__, [
            $this->process->key, 
            $this->channel->key
        ]);

        // $categories = $this->bag[$this->process] ?? null;
        
        // StorageCategory::perform('storeBatch', $categories);

        // Log::channel(Log::PROCESSOR_CATEGORIES)->info('CategoriesProcessor@store completed', []);

        // return $this;
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
            $this->channel->key
        ]);

        // StorageCategory::perform('publishAll');
        
        // // if(($this->config['auto_active'] ?? false)) 
        // // {
        // //     StorageCategory::perform('activateAll');            
        // // }

        // Log::channel(Log::PROCESSOR_CATEGORIES)->info('CategoriesProcessor@publish done!', []);        
	}			
}

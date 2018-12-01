<?php

namespace App\Models\StorageCategory\Traits\Acts;

use App\Models\{
    Channel\Channel,
    StorageCategory\StorageCategory
};
use App\Exceptions\Models\StorageCategoryException as Exception; 


/**
 * Store Trait 
 * 
 * Storage category store acts
 */
trait Store
{
    /**
     * Store a batch of Storage Categories records
     * 
     * The $categories should have the following contents:
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
     * @param array $categories
     * @return void
     */
    public function storeBatch($categories)
    {
        if(!is_array($categories)) throw new Exception(Exception::INVALID_INPUT . ' | storeBatch requires array | given input: ' . print_r($categories, 1));

        $this->affected['storage_categories'] = [];

        foreach($categories as $channel_key => $channel_categories) 
        {
            $channel = Channel::where('key', $channel_key)->first();

            if(!isset($channel->id)) throw new Exception(Exception::STORE_INVALID_CHANNEL_KEY . ' | key: ' .  $channel_key);            

            foreach($channel_categories as $k => $category_data) 
            {                
                $channel_category_id = $category_data['channel_category_id'] ?? null;

                if(!is_numeric($channel_category_id)) throw new Exception(Exception::INVALID_CHANNEL_CATEGORY_ID . ' | channel_category_id : ' . var_export($channel_category_id, 1));

                unset($category_data['channel_category_id']); // adjustment for updateOrCreate

                $category_data['channel_id'] = $channel->id;
                                
                // if there's a StorageCategory with the given channel_category_id, set the rest of the data to the given $category_data, otherwise create it.
                $storageCategory = StorageCategory::updateOrCreate(['channel_category_id' => $channel_category_id], $category_data);

                $this->affected['storage_categories'][] = $storageCategory->id;            
            }
        }
    }
    

    /**
     * Store single storage category
     * 
     * @param array $input
     * @return void
     */
    public function store($input) 
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }    
}
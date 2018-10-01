<?php

namespace App\Models\StorageCategory\Traits\Acts;

use App\Models\StorageCategory\StorageItem;
use App\Exceptions\Models\StorageItemException as Exception; 


/**
 * Store Trait 
 * 
 * Storage item store acts
 */
trait Store
{
    /**
     * Store a batch of Storage Categories records
     * 
     * The $items should have the following contents:
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
     * @param array $items
     * @return void
     */
    public function storeBatch($items)
    {
        if(!is_array($items)) throw new Exception(Exception::INVALID_INPUT . ' | storeBatch requires array | given input: ' . print_r($items, 1));

        $this->affected['storage_items'] = [];

        foreach($items as $channel_key => $channel_categories) 
        {
            if(!isset($channel->id)) throw new Exception(Exception::STORE_INVALID_CHANNEL_KEY . ' | key: ' .  $channel_key);            

            foreach($channel_categories as $storage_category_id => $storage_category_items) 
            {                
                if(!is_array($storage_category_items)) throw new Exception(Exception::INVALID_INPUT . ' | storeBatch requires array in category items level | given input: ' . print_r($storage_category_items, 1));    

                foreach($storage_category_items as $item_data) 
                {
                    $channel_item_id = $category_data['channel_item_id'] ?? null;

                    if(!is_numeric($channel_item_id)) throw new Exception(Exception::INVALID_CHANNEL_ITEM_ID . ' | channel_item_id : ' . var_export($channel_item_id, 1));
    
                    unset($item_data['channel_item_id']); // adjustment for updateOrCreate
                                        
                    // if there's a StorageItem record with the given channel_item_id, update it with the given data, otherwise create it.
                    $storageItem = StorageCategory::updateOrCreate(['channel_item_id' => $channel_item_id], $item_data);
    
                    $this->affected['storage_items'][] = $storageItem->id;            
                }
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
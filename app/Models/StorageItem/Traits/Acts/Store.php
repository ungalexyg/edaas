<?php

namespace App\Models\StorageItem\Traits\Acts;

use App\Models\StorageItem\StorageItem;
use App\Exceptions\Models\StorageItemException as Exception; 


/**
 * Store Trait 
 * 
 * Storage item store acts
 */
trait Store
{
    /**
     * Store a batch of Storage Items records
     * 
     * The $items should have the following contents:
     *  
     * [items] => Array // process name
     *   (
     *       [aliexpress] => Array // channel key
     *           (
     *               [123] => Array // storage_category_id
     *                   ( 
	 * 						 [32321793066] => Array // channel_item_id
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

       // dd($items);

        foreach($items as $channel_key => $channel_categories) 
        {
            if(!is_array($channel_categories)) throw new Exception(Exception::INVALID_INPUT);            

            foreach($channel_categories as $storage_category_id => $storage_category_items) 
            {                
                if(!is_array($storage_category_items)) throw new Exception(Exception::INVALID_INPUT);    

                foreach($storage_category_items as $item_data) 
                {
                    $channel_item_id = $item_data['channel_item_id'] ?? null;

                    if(!is_numeric($channel_item_id)) throw new Exception(Exception::STORE_INVALID_CHANNEL_ITEM_ID . ' | channel_item_id : ' . var_export($channel_item_id, 1));
    
                    $item_data['storage_category_id'] = $storage_category_id;

                    unset($item_data['channel_item_id']); // adjustment for updateOrCreate
                                    
                    //dd($channel_item_id, $item_data);    

                    // if there's a StorageItem record with the given channel_item_id, update it with the given dat a, otherwise create it.
                    $storageItem = StorageItem::updateOrCreate(['channel_item_id' => $channel_item_id], $item_data);
    
                    $this->affected['storage_items'][] = $storageItem->id;            
                }
            }
        }
    }
    

    /**
     * Store single storage item
     * 
     * @param array $input
     * @return void
     */
    public function store($input) 
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }    
}
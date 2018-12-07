<?php

namespace App\Models\Collectors\Aliexpress;

use App\Enums\ProcessableEnum as Processable;
use App\Models\Collectors\Base\BaseCollector;
use App\Models\Collectors\Aliexpress\Exceptions\CAliexpressItemException as Exception;


/**
 * Collection Model - Aliexpress Item 
 */
class CAliexpressItem extends BaseCollector 
{
    /**
     * Associate collector model with it's processs key
     * 
     * @var string
     */
    protected $process_key = Processable::KEY_ALIEXPRESS_ITEMS;


    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = Processable::TABLE_ALIEXPRESS_ITEMS;    

    
    // /**
    //  * Store a batch of records
    //  * 
    //  * @param array $batch
    //  * @return void
    //  */
    // public function storeBatch(array $batch)
    // {
    //     foreach($batch as $record) 
    //     {
    //         $category_id = $record['category_id'] ?? null;

    //         if(!is_numeric($category_id)) throw new Exception(Exception::INVALID_CHANNEL_CATEGORY_ID . ' | category_id : ' . var_export($category_id, 1));

    //         unset($record['category_id']); // adjustment for updateOrCreate
                            
    //         $storageCategory = static::$self::updateOrCreate(['category_id' => $category_id], $record); 
    //     }    
    // }   

    
    /**
     * Store a batch of records
     * 
     * @param array $batch
     * @return void
     */
    public function storeBatch(array $batch)
    {
        foreach($batch as $category_id => $items) 
        {
            foreach($items as $item_id => $item) 
            {
                $item_id = $item['item_id'] ?? null;

                if(!is_numeric($item_id)) throw new Exception(Exception::INVALID_CHANNEL_ITEM_ID . ' | item_id : ' . var_export($item_id, 1));
    
                unset($item['item_id']); // adjustment for updateOrCreate
                    
                // dd(static::$self->table);

                // if there's a record with the given item_id, set the rest of the data to the given $record, otherwise create it.
                $r = static::$self::updateOrCreate(['item_id' => $item_id], $item); 

                // dd($r);
            }
        }    
    }    
}

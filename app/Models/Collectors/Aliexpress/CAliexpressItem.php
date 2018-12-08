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
    
                static::$self::updateOrCreate(['item_id' => $item['item_id']], $item);
            }
        }    
    }    
}

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
        dd("METHOD NOT IMPLEMENTED", __METHOD__);

        // foreach($batch as $record) 
        // {
        //     $category_id = $record['category_id'] ?? null;

        //     if(!is_numeric($category_id)) throw new Exception(Exception::INVALID_CHANNEL_CATEGORY_ID . ' | category_id : ' . var_export($category_id, 1));

        //     unset($record['category_id']); // adjustment for updateOrCreate
                            
        //     // if there's a StorageCategory with the given channel_category_id, set the rest of the data to the given $category_data, otherwise create it.
        //     $storageCategory = static::$self::updateOrCreate(['category_id' => $category_id], $record); 
        // }    
    }    
}

<?php

namespace App\Models\Collectors\Aliexpress;

use App\Enums\CollectionEnum as Collection;
use App\Models\Collectors\Base\BaseCollector;
use App\Models\Collectors\Base\Traits\CategoryFamily;
use App\Models\Collectors\Aliexpress\Exceptions\CAliexpressCategoryException as Exception;


/**
 * Aliexpress Category Collection Model
 */
class CAliexpressCategory extends BaseCollector 
{
    /**
     * Model's traits 
     */
    use CategoryFamily;

    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = Collection::ALIEXPRESS_CATEGORIES;

    
    /**
     * Store a batch of records
     * 
     * @param array $batch
     * @return void
     */
    public function storeBatch(array $batch)
    {
        foreach($batch as $record) 
        {
            $category_id = $record['category_id'] ?? null;

            if(!is_numeric($category_id)) throw new Exception(Exception::INVALID_CHANNEL_CATEGORY_ID . ' | category_id : ' . var_export($category_id, 1));

            unset($record['category_id']); // adjustment for updateOrCreate
                            
            // if there's a StorageCategory with the given channel_category_id, set the rest of the data to the given $category_data, otherwise create it.
            $storageCategory = static::$self::updateOrCreate(['category_id' => $category_id], $record); 
        }    
    }    
}

<?php

namespace App\Models\Collectors\Aliexpress;

use App\Enums\ProcessableEnum as Processable;
use App\Models\Collectors\Base\BaseCollector;
use App\Models\Collectors\Base\Traits\CategoryFamily;
use App\Models\Collectors\Aliexpress\Exceptions\CAliexpressCategoryException as Exception;


/**
 * Collection Model- Aliexpress Category
 */
class CAliexpressCategory extends BaseCollector 
{
    /**
     * Model's traits 
     */
    use CategoryFamily;


    /**
     * Associate collector model with it's processs key
     * 
     * @var string
     */
    protected $process_key = Processable::KEY_ALIEXPRESS_CATEGORIES;

    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = Processable::TABLE_ALIEXPRESS_CATEGORIES;


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
                            
            static::$self::updateOrCreate(['category_id' => $category_id], $record); 
        }    
    }    
}

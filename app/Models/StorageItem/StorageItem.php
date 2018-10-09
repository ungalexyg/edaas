<?php

namespace App\Models\StorageItem;

use App\Models\Base\BaseModel;
use App\Models\StorageItem\Traits\Relations;
use App\Models\StorageItem\Traits\Scopes;
use App\Models\StorageItem\Traits\Validations;
use App\Models\StorageItem\Traits\Acts\Acts;

/**
 * Storage Category Model
 */
class StorageItem extends BaseModel implements IStorageItem
{
    /**
     * Model's traits 
     */
    use Relations, Scopes, Validations, Acts; 

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'storage_items';    
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable
}

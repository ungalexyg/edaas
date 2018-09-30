<?php

namespace App\Models\StorageItem;

use App\Models\Base\BaseModel;


/**
 * Storage Category Model
 */
class StorageItem extends BaseModel implements IStorageItem
{
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

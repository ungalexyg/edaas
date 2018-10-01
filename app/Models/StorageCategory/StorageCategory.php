<?php

namespace App\Models\StorageCategory;

use App\Models\Base\BaseModel;
use App\Models\StorageCategory\Traits\Relations;
use App\Models\StorageCategory\Traits\Scopes;
use App\Models\StorageCategory\Traits\Validations;
use App\Models\StorageCategory\Traits\Acts\Acts;
use App\Enums\DBColumnsEnum as Column;

/**
 * Storage Category Model
 */
class StorageCategory extends BaseModel implements IStorageCategory
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
    protected $table = 'storage_categories';    


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable


    // /**
    //  * Catch model's events on booting
    //  *
    //  * @return void
    //  */
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model)
    //     {
    //         $model->{Column::PROCESS_COUNT} = date("Y-m-d H:i:s");
    //     });
    // }
}

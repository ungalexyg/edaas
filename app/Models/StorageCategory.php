<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;


/**
 * Storage Category Model
 */
class StorageCategory extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'storage_categories';    


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    //public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [];    
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable


    /**
     * Connect the storageCategory with the Category
     */
    public function category()
    {
        return $this->hasOne(Category::class);
    }
    
}

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
    

    /**
     * Get parent category (as defined in the channel) 
     */
    public function parent() 
    {
        return $this->belongsTo(StorageCategory::class, 
            'parent_channel_category_id',  // use this fk from curr record
            'channel_category_id' // to find parent with the same value in this key
        );
    }

    
    /**
     * Get channel's category childrens (as defined in the channel) 
     */    
    public function children() 
    {
        return $this->hasMany(StorageCategory::class, 
            'parent_channel_category_id',  // all the children have this fk
            'channel_category_id' // with the value that curr reord has in this local key
        );        
    }    
}




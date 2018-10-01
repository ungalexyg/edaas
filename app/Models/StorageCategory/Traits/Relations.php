<?php
namespace App\Models\StorageCategory\Traits;

use App\Models\Category\Category;
use App\Models\StorageCategory\StorageCategory;


/**
 * Storage Category Relations 
 */
trait Relations
{
    /**
     * Connect the storageCategory with the Category
     */
    public function category()
    {
        return $this->hasOne(Category::class);
    }
    

    /**
     * Get storage category parent 
     * 
     * ! @note  
     * this relation should NOT be used directly since it is based on ids from several channels, 
     * instead, use the local scope scopeWithParent() that based on this relation 
     */
    public function parent() 
    {
        return $this->belongsTo(StorageCategory::class, 
            'parent_channel_category_id',  // use this fk from curr record
            'channel_category_id' // to find parent with the same value in this key
        );
    }
    

    /**
     * Get storage category childrens 
     * 
     * ! @note
     * this relation should NOT be used directly since it is based on ids from several channels, 
     * instead, use the local scope scopeWithChildren() that based on this relation 
     */    
    public function children() 
    {
        return $this->hasMany(StorageCategory::class, 
            'parent_channel_category_id',  // all the children have this fk
            'channel_category_id' // with the value that curr reord has in this local key
        );        
    }    
}




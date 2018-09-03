<?php

namespace App\Models\Category\Traits;

use App\Models\StorageCategory\StorageCategory;


/**
 * Category Relations 
 */
trait Relations
{
    /**
     * Connect the Category with the storageCategory
     */
    public function storage()
    {
        return $this->hasOne(StorageCategory::class);
    }


    /**
     * Get parent category 
     */
    public function parent() 
    {
        return $this->belongsTo(StorageCategory::class, 'parent_category_id');
    }

    
    /**
     * Get category childrens 
     */    
    public function children() 
    {
        return $this->hasMany(StorageCategory::class, 'parent_category_id', 'id');        
    }    
}




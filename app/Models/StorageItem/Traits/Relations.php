<?php
namespace App\Models\StorageItem\Traits;

// use App\Models\Category\Category;
use App\Models\StorageCategory\StorageCategory;


/**
 * Storage Item Relations 
 */
trait Relations
{
    /**
     * Connect the storageItem with Item
     * 
     */
    public function item() 
    {

    } 


    /**
     * Connect the storageItem storageCategory
     * 
     */
    public function storageCategory() 
    {
        return $this->belongsTo(StorageCategory::class, 'storage_category_id');
    }     
}

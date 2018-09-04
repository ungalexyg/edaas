<?php

namespace App\Models\StorageCategory\Traits;

use App\Models\{
    Category\Category,
    StorageCategory\StorageCategory
};


/**
 * Storage Category Scopes 
 */
trait Scopes
{
    /**
     * Get storage category with it's parent in the channel 
     * 
     * useage : StorageCategory::withParent($child_id)->first(); 
     * 
     * @param Builder $query natively injected 
     * @param int $child_id child's storage_category.id
     * @return void
     */
    public function scopeWithParent($query, $child_id) 
    {
        $storage_category = StorageCategory::find($child_id);        

        $query->with(['parent' => function($q) use ($storage_category) {

            $q->where('channel_id','=', $storage_category->channel_id);

        }])->find($storage_category->id);         
    }


    /**
     * Get storage category with it's children in the channel 
     * 
     * useage : StorageCategory::withChildren($parent_id)->first(); 
     * 
     * @param Builder $query natively injected 
     * @param int $parent_id parent's storage_category.id
     * @return void
     */    
    public function scopeWithChildren($query, $parent_id) 
    {
        $storage_category = StorageCategory::find($parent_id);        

        $query->with(['children' => function($q) use ($storage_category) {

            $q->where('channel_id','=', $storage_category->channel_id);
            
        }])->find($storage_category->id); 
    }


    /**
     * Get published storage category records
     * 
     * useage : StorageCategory::published()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopePublished($query) 
    {
        $query->where('published', '=', 1);
    }


    /**
     * Get unpublished storage category records
     * 
     * useage : StorageCategory::unpublished()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeUnpublished($query) 
    {
        $query->where('published', '=', 0);
    }


    /**
     * Get active storage category records
     * 
     * useage : StorageCategory::active()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeActive($query) 
    {
        $query->where('active', '=', 1);
    }

    /**
     * Get unactive storage category records
     * 
     * useage : StorageCategory::unactive()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeUnactive($query) 
    {
        $query->where('active', '=', 0);
    }       
}

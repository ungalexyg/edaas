<?php

namespace App\Models\StorageCategory\Traits;

use Illuminate\Support\Carbon;
use App\Models\Category\Category;
use App\Enums\DBColumnsEnum as Column;
use App\Enums\ProcessEnum as Processes;
use App\Models\StorageCategory\StorageCategory;

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
}

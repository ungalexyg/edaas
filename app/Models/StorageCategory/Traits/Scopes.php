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
    
    
    /**
     * Scope mature storage category records
     *  
     * Bsed on processes config, generate similar to the following query : 
     * 
     *  select * from `storage_categories` 
     *  where `channel_id` = ? 
     *  and `last_process` <= ? 
     *  and `active` = 1 
     *  order by `storage_categories`.`last_process` asc 
     *  limit 2
     * 
     * @see config('processes.settings')
     * @param Illuminate\Database\Query\Builder // injected natively
     * @param int $channel_id
     * @return void
     */
    public function scopeMatureStorageCategories($query, $channel_id)
    {
        $config     = config('processes.settings.'. Processes::ITEMS);

        $min_age    = $config['mature_category'] ?? 60; // 1 hour 
        
        $limit      = $config['limit_categories'] ?? 1; 
        
        $datetime   = Carbon::now()->subMinutes($min_age)->toDateTimeString();
        
        $query
            ->where('channel_id', '=', $channel_id)
            ->where(Column::LAST_PROCESS,'<=', $datetime)
            ->where('active','=', 1)
            ->orderBy($this->table . '.' . Column::LAST_PROCESS, 'asc')
            ->take($limit);        
    }       
}

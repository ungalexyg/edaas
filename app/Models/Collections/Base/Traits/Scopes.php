<?php

namespace App\Models\Collections\Base\Traits;

// use Illuminate\Support\Carbon;
// use App\Models\Category\Category;
// use App\Models\StorageCategory\StorageCategory;
use App\Enums\CollectionStatusEnum as Collections;


/**
 * Storage Category Scopes 
 */
trait Scopes
{
    /**
     * Get published storage category records
     * 
     * useage : CollectionModel::published()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopePublished($query) 
    {
        $query->where(static::COLLECTION_STATUS, '=', Collections::PUBLISHED);
    }


    /**
     * Get unpublished storage category records
     * 
     * useage : CollectionModel::unpublished()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeUnpublished($query) 
    {
        $query->where(static::COLLECTION_STATUS, '=', Collections::ARCHIVED);
    }


    /**
     * Get active storage category records
     * 
     * useage : CollectionModel::active()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeActive($query) 
    {
        $query->where(static::COLLECTION_STATUS, '=', Collections::ACTIVE);
    }

    /**
     * Get unactive storage category records
     * 
     * useage : CollectionModel::unactive()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeUnactive($query) 
    {
        $query->where(static::COLLECTION_STATUS, '=', Collections::PAUSED);
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
    public function scopeMatureCollection($query, $channel_id)
    {
        // $config     = config('processes.settings.'. Processes::ITEMS);

        // $min_age    = $config['mature_category'] ?? 60; // 1 hour 
        
        // $limit      = $config['limit_categories'] ?? 1; 
        
        // $datetime   = Carbon::now()->subMinutes($min_age)->toDateTimeString();
        
        // $query
        //     ->where('channel_id', '=', $channel_id)
        //     ->where('active','=', 1)
        //     ->where(Column::LAST_PROCESS,'<=', $datetime)
        //     ->orderBy($this->table . '.' . Column::LAST_PROCESS, 'asc')
        //     ->take($limit);        
    }       
}

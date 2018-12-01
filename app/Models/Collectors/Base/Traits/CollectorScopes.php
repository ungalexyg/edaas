<?php

namespace App\Models\Collectors\Base\Traits;

// use Illuminate\Support\Carbon;
use App\Enums\CollectionStatusEnum as Collections;
use App\Exceptions\ModelException as Exception;


/**
 * Collector models scopes 
 */
trait CollectorScopes
{
    /**
     * Get published collection records
     * 
     * useage : CollectionModel::published()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopePublished($query) 
    {
        $query->where(static::CONTENT_STATUS, '=', static::CONTENT_PUBLISHED);
    }


    /**
     * Get unpublished collection records
     * 
     * useage : CollectionModel::unpublished()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeUnpublished($query) 
    {
        $query->where(static::CONTENT_STATUS, '=', static::CONTENT_ARCHIVED);
    }


    /**
     * Get active collection records
     * 
     * useage : CollectionModel::active()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeActive($query) 
    {
        $query->where(static::PROCESS_STATUS, '=', static::PROCESS_ACTIVE);
    }


    /**
     * Get unactive collection records
     * 
     * useage : CollectionModel::unactive()->get(); 
     * 
     * @param Builder $query natively injected 
     * @return void
     */    
    public function scopeUnactive($query) 
    {
        $query->where(static::PROCESS_STATUS, '=', static::PROCESS_PAUSED);
    }  
    
    
    /**
     * Scope mature collection records
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

        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);

        // $config     = config('processes.settings.'. Processes::ITEMS);

        // $min_age    = $config['mature_category'] ?? 60; // 1 hour 
        
        // $limit      = $config['limit_categories'] ?? 1; 
        
        // $datetime   = Carbon::now()->subMinutes($min_age)->toDateTimeString();
        
        // $query
        //     ->where('channel_id', '=', $channel_id)
        //     ->where('active','=', 1)
        //     ->where(Column::PROCESS_LAST,'<=', $datetime)
        //     ->orderBy($this->table . '.' . Column::PROCESS_LAST, 'asc')
        //     ->take($limit);        
    }       
}

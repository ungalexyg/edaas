<?php

namespace App\Models\Collectors\Base\Traits;

// use Illuminate\Support\Carbon;

use App\Models\Collectors\Base\BaseCollectorException;


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
        $query->where(static::$processable::PUBLIC_STATUS, '=', static::$processable::PUBLIC_STATUS_PUBLISHED);
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
        $query->where(static::$processable::PUBLIC_STATUS, '=', static::$processable::PUBLIC_STATUS_HIDDEN);
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
        $query->where(static::$processable::PROCESS_STATUS, '=', static::$processable::PROCESS_STATUS_ACTIVE);
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
        $query->where(static::$processable::PROCESS_STATUS, '=', static::$processable::PROCESS_STATUS_PAUSED);
    }  
    
    
    /**
     * Scope awake collection records
     *  
     * @see config('processes.settings')
     * @param Illuminate\Database\Query\Builder // injected natively
     * @return void
     */
    public function scopeAwakeCollections($query)
    {

        // dd(static::$processable::PROCESS_STATUS);

        dd(__METHOD__);

        // $query->where('id', 2);

        // $config     = config('processes.settings.'. $this->process) ?? null;
        // $sleep      = $config['sleep'] ?? null; 
        // $limit      = $config['limit'] ?? null; 

        // if(!$config || !$sleep || !$limit) throw new Exception(Exception::INVALID_PROCESS_CONFIG . ' | config : ' . var_export($config, 1));

        // $datetime = Carbon::now()->subMinutes($sleep)->toDateTimeString();
        
        // $query
        //     ->where(static::PROCESS_STATUS, '=', static::PROCESS_ACTIVE)
        //     ->where(static::LAST_PROCESS,'<=', $datetime)
        //     ->orderBy($this->table . '.' . static::LAST_PROCESS, 'asc')
        //     ->take($limit);        
    }       
}

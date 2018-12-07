<?php

namespace App\Models\Collectors\Base\Traits;

use Illuminate\Support\Carbon;
use App\Models\Process\Process;
use App\Enums\ProcessableEnum as Processable;
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
        $query->where(Processable::PUBLIC_STATUS, '=', Processable::PUBLIC_STATUS_PUBLISHED);
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
        $query->where(Processable::PUBLIC_STATUS, '=', Processable::PUBLIC_STATUS_HIDDEN);
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
        $query->where(Processable::ACTIVE_STATUS, '=', Processable::ACTIVE_STATUS_ACTIVE);
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
        $query->where(Processable::ACTIVE_STATUS, '=', Processable::ACTIVE_STATUS_PAUSED);
    }  
    
    
    /**
     * Scope awake collection records
     *  
     * @see config('processes.settings')
     * @param Illuminate\Database\Query\Builder // injected natively
     * @return void
     */
    public function scopeAwakeProcessables($query)
    {
        $process        = Process::where('key', '=', $this->process_key)->first(); 
        $sleep_time     = Carbon::now()->subMinutes($process->sleep_minutes)->toDateTimeString();
        $multiple_limit = $process->multiple_limit;
        
        // dd($this->process_key, $process->id, $sleep_time, $multiple_limit);
        
        $query
            ->where(Processable::ACTIVE_STATUS, '=', Processable::ACTIVE_STATUS_ACTIVE)
            ->where(Processable::LAST_PROCESS,'<=', $sleep_time)
            ->orderBy($this->table . '.' . Processable::LAST_PROCESS, 'asc')
            ->take($multiple_limit);        
    }       
}

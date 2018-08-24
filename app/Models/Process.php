<?php

namespace App\Models;

use App\Models\Channel;
use Illuminate\Support\Carbon;


/**
 * Process Model
 */
class Process extends BaseModel
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;    


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['name', 'description', 'key'];    
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable


    /**
     * Fileds constants
     */
    const LAST_PROCESS = 'last_process';


    /**
     * Get the channels that attached to the process
     */
    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'channels_processes', 'process_id', 'channel_id')->withPivot(static::LAST_PROCESS);
    }    


    /**
     * Scope mature channels for process 
     * 
     * Bsed on config, generate similar to the following query : 
     * 
     *  select 
     *       `channels`.*, 
     *       `channels_processes`.`process_id` as `pivot_process_id`, 
     *       `channels_processes`.`channel_id` as `pivot_channel_id`, 
     *       `channels_processes`.`last_process` as `pivot_last_process` 
     *   from `channels` 
     *   inner join `channels_processes` on `channels`.`id` = `channels_processes`.`channel_id` 
     *   where `channels_processes`.`process_id` in (2) 
     *   and `channels_processes`.`last_process` <= '2018-08-16 17:37:44' 
     *   order by `channels_processes`.`last_process` asc 
     *   limit 2;
     *  
     * @see config('processes.settings.categories')
     * @param Illuminate\Database\Query\Builder // injected natively
     * @param string $process // processes key
     * @return void
     */
    public function scopeMatureChannels($query, $process)
    {
        $config = config('processes.settings.categories');

        $min_age = $config['min_age'] ?? (60*24); // 24 hours in minutes
        
        $limit_channels = $config['limit_channels'] ?? 1; 
        
        $datetime = Carbon::now()->subMinutes($min_age)->toDateTimeString();
        
        $query->with(['channels' => function($q) use ($datetime, $limit_channels){

            $q->wherePivot(static::LAST_PROCESS,'<=', $datetime)
            ->orderBy('channels_processes.'.static::LAST_PROCESS, 'asc')
            ->take($limit_channels);

        }])->where('key', $process);   
        
    }    
}

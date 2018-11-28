<?php

namespace App\Models\Process;

use App\Models\Base\BaseModel;
use Illuminate\Support\Carbon;
use App\Models\Channel\Channel;
use App\Enums\DBColumnsEnum as Column;


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
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable


    /**
     * Connect processable entities
     */
    public function processable()
    {
        return $this->morphTo();
    }    


    // /**
    //  * Scope mature channels for process 
    //  * 
    //  * Based on processes config, generate similar to the following query : 
    //  * 
    //  *  select 
    //  *       `channels`.*, 
    //  *       `processes_channels`.`process_id` as `pivot_process_id`, 
    //  *       `processes_channels`.`channel_id` as `pivot_channel_id`, 
    //  *       `processes_channels`.`last_process` as `pivot_last_process` 
    //  *   from `channels` 
    //  *   inner join `processes_channels` on `channels`.`id` = `processes_channels`.`channel_id` 
    //  *   where `processes_channels`.`process_id` in (2) 
    //  *   and `processes_channels`.`last_process` <= '2018-08-16 17:37:44' 
    //  *   order by `processes_channels`.`last_process` asc 
    //  *   limit 2;
    //  *  
    //  * @see config('processes.settings')
    //  * @param Illuminate\Database\Query\Builder // injected natively
    //  * @param string $process // processes key
    //  * @return void
    //  */
    // public function scopeMatureChannels($query, $process)
    // {
    //     $config     = config('processes.settings.'. $process);

    //     $min_age    = $config['mature_channel'] ?? (60*24); // 24 hours in minutes
        
    //     $limit      = $config['limit_channels'] ?? 1; 
        
    //     $datetime   = Carbon::now()->subMinutes($min_age)->toDateTimeString();
        
    //     $query->with(['channels' => function($q) use ($datetime, $limit){

    //         $q->wherePivot(Column::LAST_PROCESS,'<=', $datetime)
    //         ->orderBy($this->table . '.' . Column::LAST_PROCESS, 'asc')
    //         ->take($limit);

    //     }])->where('key', $process);   
    // }    
}

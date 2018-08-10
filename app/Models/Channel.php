<?php

namespace App\Models;


use App\Models\Process;


/**
 * Channel Model
 * 
 */
class Channel extends BaseModel
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    
    /**
     * Get the processes that attached to the channel
     */
    public function processes()
    {
        return $this->belongsToMany(Process::class, 'processes_channels', 'process_id', 'channel_id');
    }    

}

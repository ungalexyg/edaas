<?php

namespace App\Models;

use App\Models\Channel;


/**
 * Process Model
 * 
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
     * Get the channels that attached to the process
     */
    public function channnels()
    {
        return $this->belongsToMany(Channel::class, 'processes_channels', 'channel_id', 'process_id');
    }    

}

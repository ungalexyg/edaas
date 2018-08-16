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
     * Get the channels that attached to the process
     */
    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'channels_processes', 'process_id', 'channel_id')->withPivot('last_activity');
    }    

}

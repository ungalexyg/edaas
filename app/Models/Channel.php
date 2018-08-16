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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['domain', 'name', 'description', 'key'];    
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable


    /**
     * Get the processes that attached to the channel
     */
    public function processes()
    {
        return $this->belongsToMany(Process::class, 'channels_processes', 'channel_id', 'process_id')->withPivot('last_activity');
    }    

}

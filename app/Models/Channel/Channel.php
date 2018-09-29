<?php
namespace App\Models\Channel;

use App\Models\Base\BaseModel;
use App\Models\Process\Process;


/**
 * Channel Model
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
        return $this->belongsToMany(Process::class, 'processes_channels', 'channel_id', 'process_id')->withPivot('last_process');
    }    
}

<?php
namespace App\Models\Channel;

use App\Models\Base\BaseModel;
use App\Models\Process\Process;
use App\Processes\Base\IProcessable;


/**
 * Channel Model
 */
class Channel extends BaseModel implements IProcessable
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
     * Connect the channel to it's processes
     */
    public function processes()
    {
        return $this->morphMany(Process::class, 'processable');
    }    
}

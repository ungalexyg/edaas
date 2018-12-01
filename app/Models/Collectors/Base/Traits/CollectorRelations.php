<?php

namespace App\Models\Collectors\Base\Traits;

use App\Models\Channel\Channel;


/**
 * Collector models relations 
 */
trait CollectorRelations
{
    /**
     * Connect the ICollector model to it's channel
     * 
     * @return mixed
     */
    public function channel() 
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }   
}

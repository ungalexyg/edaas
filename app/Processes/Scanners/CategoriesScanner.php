<?php 
namespace App\Processes\Scanners;

use App\Models\Channel;
use App\Models\Process;
use App\Enums\Processes;


/**
 * Categories Scanner
 */ 
class CategoriesScanner extends BaseScanner 
{

    /**
     * Handle process action
     * 
     * TODO: log empty fetch results
     * 
     * @return self
     */
    public function scan() 
    {
        foreach($this->channels as $channel) 
        {    
            $this->bag[$this->process][$channel->key] = $this->loadAdapter($channel->key)->adapter->fetch();
        }            
       
        return $this;
    }

}




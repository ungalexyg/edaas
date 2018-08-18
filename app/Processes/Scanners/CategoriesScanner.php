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
     * TODO:
     * 1) get the channels //DONE
     * 2) check which should run in terms of timing // DONE
     * 3) perform scan on the next in line
     * 4) pass data to keeper
     * 5) NOTE : make sure to work with relevant seed 
     * 6) handle given channel case
     * 
     * @return self
     */
    public function scan() 
    {
        if($this->channel) 
        {
            $this->bag[$this->process][$this->channel] = $this->loadAdapter($this->channel)->adapter->fetch();
        }
        else 
        {
            $process = Process::matureChannels($this->process)->first(); // 1st process should be single result for $this->process anyway

            foreach($process->channels as $channel) 
            {    
                $this->bag[$this->process][$channel->key] = $this->loadAdapter($channel->key)->adapter->fetch();
            }            
        }
        
        return $this;
    }

}




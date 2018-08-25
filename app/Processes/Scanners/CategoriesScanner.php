<?php 
namespace App\Processes\Scanners;

use Log;
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
     * @return self
     */
    public function scan() 
    {
        foreach($this->channels as $channel) 
        {    
            $this->bag[$this->process][$channel->key] = $this->loadAdapter($channel->key)->adapter->fetch();
        }            
       
        Log::channel(Log::CATEGORIES_SCANNER)->info('scan categories completed ' . (!empty($this->bag) ? 'successfully with full bag :)' : 'with empty bag :/') , ['in' => __METHOD__ .':'.__LINE__]);

        return $this;
    }
}




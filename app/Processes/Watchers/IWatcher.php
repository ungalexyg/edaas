<?php 

namespace App\Processes\Watchers;

use App\Processes\Processors\Base\IProcess;


/**
 * Watcher Interface 
 */ 
interface IWatcher extends IProcess 
{
    
    /**
     * Watch prospects
     * 
     * @return self
     */
    public function watch();	

}




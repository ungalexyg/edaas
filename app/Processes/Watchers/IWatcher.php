<?php 
namespace App\Processes\Watchers;

use App\Processes\Base\IProcess;


/**
 * Watcher Interface 
 */ 
interface IWatcher extends IProcess {

    /**
     * Compare if record has changes 
     */
	public function compare();
	

    /**
     * Watch prospects
     */
    public function watch();	
}




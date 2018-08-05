<?php 
namespace App\Processes\Watchers;

use App\Processes\Base\IProcessor;


/**
 * Watcher Interface 
 */ 
interface IWatcher extends IProcessor {

    /**
     * Compare if record has changes 
     */
	public function compare();
	

    /**
     * Watch prospects
     */
    public function watch();	
}




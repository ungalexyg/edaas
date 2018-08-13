<?php 
namespace App\Processes\Watchers;


/**
 * Watcher Interface 
 */ 
interface IWatcher {

    /**
     * Compare if record has changes 
     */
	public function compare();
	

    /**
     * Watch prospects
     */
    public function watch();	
}




<?php 
namespace App\Processes\Watchers;


/**
 * Watcher Interface 
 */ 
interface IWatcher {

    
    /**
     * Handle process action
     */
	public function handle();


    /**
     * Watch prospects
     */
    public function watch();	

}




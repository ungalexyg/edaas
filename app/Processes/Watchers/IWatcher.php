<?php 
namespace App\Processes\Watchers;


/**
 * Watcher Interface 
 */ 
interface IWatcher {

    
    /**
     * Handle process action
     * 
     * @return self
     */
	public function handle();


    /**
     * Watch prospects
     * 
     * @return self
     */
    public function watch();	

}




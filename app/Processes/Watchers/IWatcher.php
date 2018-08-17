<?php 
namespace App\Processes\Watchers;

use App\Processes\Processors\Base\IProcess;


/**
 * Watcher Interface 
 */ 
interface IWatcher extends IProcess {

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




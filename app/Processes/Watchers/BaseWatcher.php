<?php 
 /**
 * --------------------------------------------------------------------------
 *  Watcher
 * --------------------------------------------------------------------------
 * 
 * The Watcher whatching the realized data, tracking, comparing & mark their performance according to set of conditions across mutiple channels.
 * 
 * TODO: write the conditions
 * 
 */ 

namespace App\Processes\Watchers;

use App\Processes\Base\Processor;

/**
 * Base Watcher
 */ 
abstract class BaseWatcher extends Processor implements IWatcher {


	/**
	 * Start a process
	 * 
	 * @return mixed
	 */
	public function start() 
	{   
		return $this->watch();
	}


    // /**
    //  * Compare if record has changes 
    //  */
    // abstract public function compare();


    // /**
    //  * Compare if record has changes 
    //  */
    // abstract public function compare();    

}




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


/**
 * Base Watcher
 */ 
abstract class BaseWatcher extends BaseProcess implements IWatcher {


    /**
     * Compare if record has changes 
     */
    abstract public function compare();

}




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
 * TODO: 
 * check Observers:
 * https://medium.com/sammich-shop/simple-record-history-tracking-with-laravel-observers-48a2e3c5698b
 * 
 * 
 */ 

namespace App\Processes\Watchers;

use App\Processes\Traits\HasProcess;


/**
 * Base Watcher
 */ 
abstract class BaseWatcher implements IWatcher {

	/**
	 * Use process traits
	 */
	use HasProcess;


    /**
     * Handle process action
     */
	abstract public function handle();


	/**
	 * Watch prospects
	 */
	abstract public function watch();		
	
}




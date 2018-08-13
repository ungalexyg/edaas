<?php 

namespace App\Processes\Adapters\Base;


/**
 * Base Adapter
 */
 abstract class BaseAdapter implements IAdapter {


	/**
	 * Fetch adapter's targets
     * 
     * @return mixed
	 */        
    abstract public function fetch(); 

 }




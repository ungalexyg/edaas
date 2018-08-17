<?php 

namespace App\Processes\Adapters\Aliexpress;

use App\Processes\Adapters\Base\BaseAdapter;

/**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 * - visit each category in Ali
 * - grab products by newest with orders count 
 * - store the 'category-newest' dataset
 * - run the process every 4 hours to compare changes per item
 * - products with X orders increased will be stored as 'Prospects' for forther treatment  
 */


/**
 * Aliexpress Adapter
 * 
 * Handle Aliexpress operations
 */
 abstract class AliexpressAdapter extends BaseAdapter {

	/**
	 * Fetch targets
	 * 
     * @return mixed
	 */        
    abstract public function fetch(); 

 }





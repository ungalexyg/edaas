<?php 

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

 
namespace App\Processes\Adapters\Aliexpress;

use App\Enums\Channels;
use App\Processes\Adapters\Base\BaseAdapter;


/**
 * Base Aliexpress Adapter
 */
 abstract class BaseAliexpressAdapter extends BaseAdapter 
 {

	/**
	 * Channel adapter key
	 * 
	 * @var string
	 */
	protected $key = Channels::ALIEXPRESS;


	/**
	 * Channel adapter primary domain
	 * 
	 * @var string
	 */	
	protected $domain = 'aliexpress.com';


	/**
	 * Fetch targets
	 * 
     * @return mixed
	 */        
    abstract public function fetch(); 

 }





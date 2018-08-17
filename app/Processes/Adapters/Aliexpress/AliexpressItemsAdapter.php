<?php 

namespace App\Processes\Adapters\Aliexpress;


/**
 * --------------------------------------------------------------------------
 *  Aliexpress.com Adapter
 * --------------------------------------------------------------------------
 * Handle Aliexpress categories operations
 * 
 * All categories page :
 * https://www.aliexpress.com/all-wholesale-products.html?spm=2114.11010108.22.1.650c649bElLsCz
 * 
 */


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
  * Aliexpress Items Adapter
  */
 class AliexpressItemsAdapter extends BaseAliexpressAdapter {


	/**
	 * Fetch targets
	 * 
     * @return mixed
	 */        
    public function fetch() 
    {
        
    }

 }





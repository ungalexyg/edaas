<?php 

namespace App\Processes\Adapters\Aliexpress;


/**
 * --------------------------------------------------------------------------
 *  Resources
 * --------------------------------------------------------------------------
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
 */


/**
 * Aliexpress Categories Adapter 
 * 
 * Handle Aliexpress categories operations
 */
 class AliexpressCategoriesAdapter extends AliexpressAdapter {


	/**
	 * Fetch targets
	 * 
     * @return mixed
	 */        
    public function fetch() 
    {
        return __METHOD__;
    }

 }





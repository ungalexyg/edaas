<?php 
namespace App\Processes\Adapters\Base;

/**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 *
 * TODO: check items uploads dates to count orders per date
 * 
 * 
 * 
 */


 /**
  * Aliexpress Adapter
  */
 class Aliexpress extends BaseAdapter {


	/**
	 * Scan Prospect Items
	 * 
	 * - visit each category in Ali
	 * - grab products by newest with orders count 
	 * - store the 'category-newest' dataset
	 * - run the process every 4 hours to compare changes per item
	 * - products with X orders increased will be stored as 'Prospects' for forther treatment  
     * 
     * @return mixed
	 */        
    public function ScanProspects() 
    {
        
    }

 }





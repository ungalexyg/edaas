
<?php 



/**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 * 
 * DONE: check how to find the search query (products titles)
 * see $this->locateProspects()
 * 
 */



/**
 * Locate prospect items 
 */ 
class Locator {


	/**
	 * Locate Prospect Items
	 * 
	 * - visit each category in Ali
	 * - grab products by newest with orders count 
	 * - store the 'category-newest'dataset
	 * - run the process every 4 hours to compare changes per item
	 * - products with X orders increased will be stored as 'Prospects' for forther treatment  
	 */
    public function locateProspects()
    {
		
    }

}




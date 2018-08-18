<?php 

namespace App\Processes\Keepers;

use App\Enums\Process;


/**
 * Categories Keeper
 */ 
class CategoriesKeeper extends BaseKeeper 
{

	/**
	 * Store fresh scanned data in the storage
	 * 
	 * @return self
	 */
	public function store()
    {
        // TODO: migrations ...
        
        echo " Storing ... ";

        return $this;
    }


	/**
	 * Publish data from the storage to the public tables
	 * 
     *  TODO: methd not implemented
     * 
	 * @return self
	 */
    public function publish() 
    {
        echo " Publishing ... ";

        return $this;
    }

}




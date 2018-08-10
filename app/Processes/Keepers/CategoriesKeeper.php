<?php 
namespace App\Processes\Keepers;


/**
 * Categories Keeper
 */ 
class CategoriesKeeper extends BaseKeeper {


    /**
     * Watch prospects 
     */
    public function keep() 
    {
        echo "Keeping ...";

        //$this->bag['keeped'] = $this->bag['scanned'];

        return $this;
    }

}




<?php 

namespace App\Processes\Keepers;

use App\Enums\Process;


/**
 * Categories Keeper
 */ 
class CategoriesKeeper extends BaseKeeper 
{
    
    /**
     * Handle process action
     * 
     * @return self
     */
    public function handle() 
    {
        $this->keep();

        return $this;
    }


    /**
     * Watch prospects 
     * 
     * @return self
     */
    public function keep() 
    {
        echo "Keeping ...";

       

        $this->bag['got_scanned'] = $this->bag['scanned'];
        $this->bag['keeped'] = 'keeped';
        // [
        //     $this->scanner->prop => $this->bag['scanned']
        // ];

        return $this;
    }

}




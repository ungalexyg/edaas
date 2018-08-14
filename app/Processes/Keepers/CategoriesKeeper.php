<?php 
namespace App\Processes\Keepers;
use App\Lib\Enums\Process;

/**
 * Categories Keeper
 */ 
class CategoriesKeeper extends BaseKeeper {


    public $prop = 'CategoriesKeeper';

    
    /**
     * Handle process action
     */
    public function handle() 
    {
        $this->keep();
    }


    /**
     * Watch prospects 
     */
    public function keep() 
    {
        echo "Keeping ...";

       

        $this->bag['keeped'] = $this->bag['scanned'];
        // [
        //     $this->scanner->prop => $this->bag['scanned']
        // ];

        return $this;
    }

}




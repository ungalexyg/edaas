<?php 
namespace App\Processes\Scanners;
use App\Lib\Enums\Process;

/**
 * Categories Scanner
 */ 
class CategoriesScanner extends BaseScanner {



    /**
     * Handle process action
     */
    public function handle() 
    {
        $this->scan();
    }


    /**
     * Perform scaning process
     */
    public function scan() 
    {
        echo 'scan<hr />';

        // $this->bag = $this->adapter()->fetch();

        echo "Scaning .....";

        $this->processor->bag['scanned'] = 'value'; 

        // return $this;
    }

}




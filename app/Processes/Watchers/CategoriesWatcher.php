<?php 

namespace App\Processes\Watchers;

use App\Enums\Process;


/**
 * Categories Watcher
 */ 
class CategoriesWatcher extends BaseWatcher 
{

    /**
     * Watch prospects 
     * 
     * @return self
     */
    public function watch() 
    {
        echo "Watching ...";
        
        return $this;
    }
    
}




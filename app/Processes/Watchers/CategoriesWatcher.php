<?php 

namespace App\Processes\Watchers;

use App\Enums\Process;


/**
 * Categories Watcher
 */ 
class CategoriesWatcher extends BaseWatcher 
{

	/**
	 * Handle process action
	 * 
	 * @return self
	 */
	public function handle() 
	{   
        $this->watch();
        
        return $this;
	}


    /**
     * Watch prospects 
     * 
     * @return self
     */
    public function watch() 
    {
        echo "Watching ...";
        
        $this->bag['watched'] = $this->bag['keeped'];

        //$this->compare();
        
        return $this;
    }
    
}




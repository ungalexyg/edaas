<?php 
namespace App\Processes\Watchers;

use App\Lib\Enums\Process;


/**
 * Categories Watcher
 */ 
class CategoriesWatcher extends BaseWatcher {

    public $prop = 'CategoriesWatcher';


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




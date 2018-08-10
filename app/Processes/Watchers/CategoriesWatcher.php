<?php 
namespace App\Processes\Watchers;


/**
 * Categories Watcher
 */ 
class CategoriesWatcher extends BaseWatcher {


    /**
     * Watch prospects 
     */
    public function watch() 
    {
        echo "Watching ...";
        
        //$this->bag['watched'] = $this->bag['keeped'];

        $this->compare();

        return $this;
    }


    /**
     * Compare prospects 
     */
    public function compare() 
    {
        echo "Comparing ...";

        //$this->bag['compared'] = $this->bag['keeped'];

        return $this;
    }    

}




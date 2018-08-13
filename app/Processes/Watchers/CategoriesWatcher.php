<?php 
namespace App\Processes\Watchers;

use App\Lib\Enums\Process;


/**
 * Categories Watcher
 */ 
class CategoriesWatcher extends BaseWatcher {

    public $prop = 'CategoriesWatcher';


	/**
	 * Watcher construct
	 * 
	 * @return self
	 */
	public function __construct() 
	{
        var_dump(__METHOD__); echo '<br />';

        parent::__construct();

        if(!$this->process) 
        {
            $this->setProcess(Process::CATEGORIES);
        }

		return $this;
    } 
    

    /**
     * Watch prospects 
     */
    public function watch() 
    {
        echo "Watching ...";
        
        $this->bag['watched'] = $this->bag['keeped'];

        //$this->compare();

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




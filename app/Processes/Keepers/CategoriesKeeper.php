<?php 
namespace App\Processes\Keepers;
use App\Lib\Enums\Process;

/**
 * Categories Keeper
 */ 
class CategoriesKeeper extends BaseKeeper {


    public $prop = 'CategoriesKeeper';

	/**
	 * Scanner construct
	 * 
	 * @return self
	 */
	public function __construct() 
	{var_dump(__METHOD__); echo '<br />';
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




<?php 
namespace App\Processes\Scanners;
use App\Lib\Enums\Process;

/**
 * Categories Scanner
 */ 
class CategoriesScanner extends BaseScanner {

    public $prop = 'CategoriesScanner';


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
     * Scan process 
     */
    public function scan() 
    {
        echo 'scan<hr />';

        // $this->bag = $this->adapter()->fetch();

        echo "Scaning .....";

        $this->bag['scanned'] = 'value'; 

        // return $this;
    }

}




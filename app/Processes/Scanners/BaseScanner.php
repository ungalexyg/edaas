<?php 

namespace App\Processes\Scanners;

use App\Processes\Traits\HasProcess;
use App\Processes\Traits\HasAdapter;


/**
 * Base Scanner
 * 
 * Locate raw data from assigned channels,  
 * then pass them to the Keeper for forther handling and storage. 
 */ 
abstract class BaseScanner implements IScanner 
{

	
	/**
	 * Use process traits
	 */
	use HasProcess, HasAdapter;


    /**
     * Handle process action
	 * 
	 * @return self
     */
	abstract public function handle();

}




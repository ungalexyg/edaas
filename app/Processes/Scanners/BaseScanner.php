<?php 
/**
 * --------------------------------------------------------------------------
 *  Scanner
 * --------------------------------------------------------------------------
 * 
 * Locat raw data & "Prospect Items" from given "Prospects Channels", 
 * then pass them to the Keeper for forther handling and storage.
 * 
 * Prospects Channels :
 *  start with Ali
 */ 


namespace App\Processes\Scanners;

use App\Processes\Base\BaseProcess;


/**
 * Base Scanner
 */ 
abstract class BaseScanner extends BaseProcess implements IScanner {



	/**
	 * Start a process
	 * 
	 * @return mixed
	 */
	public function start() 
	{
		return $this->scan();
	}


    // /**
    //  * Compare if record has changes 
    //  */
    // public function scan() 
    // {
    //     return $this;
    // }    

}




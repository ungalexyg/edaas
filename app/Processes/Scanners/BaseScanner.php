<?php 
/**
 * --------------------------------------------------------------------------
 *  Scanner
 * --------------------------------------------------------------------------
 * 
 * Locate raw data & "Prospect Items" from given "Prospects Channels", 
 * then pass them to the Keeper for forther handling and storage.
 * 
 * Prospects Channels :
 *  start with Ali
 */ 


namespace App\Processes\Scanners;

//use App\Exceptions\ScannerException;
use App\Processes\Traits\HasProcess;

/**
 * Base Scanner
 */ 
abstract class BaseScanner implements IScanner {

	/**
	 * Use process traits
	 */
	use HasProcess;


    /**
     * Handle process action
	 * 
	 * @return self
     */
	abstract public function handle();


    /**
     * Perform scaning process
	 * 
	 * @return self
     */
	abstract public function scan();

}




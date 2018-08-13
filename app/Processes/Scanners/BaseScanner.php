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

use App\Processes\Base\Processor;
use App\Exceptions\ScannerException;
use App\Processes\Base\Traits\HasProcessKit;

/**
 * Base Scanner
 */ 
abstract class BaseScanner implements IScanner {

	/**
	 * Use process kit
	 */
	use HasProcessKit;


	/**
	 * Start a process
	 * 
	 * @return mixed
	 */
	public function process() 
	{
		return $this->scan();
	}


	/**
	 * Get process status data
	 * 
	 * @return mixed
	 */	
	public function status() 
	{
		throw new ScannerException(ScannerException::METHOD_NOT_IMPLEMENTED);
	}

}




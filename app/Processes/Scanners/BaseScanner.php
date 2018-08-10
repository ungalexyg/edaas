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


/**
 * Base Scanner
 */ 
abstract class BaseScanner implements IScanner {

	/**
	 * Scanner bag
	 * 
	 * @var array
	 */
	protected $bag=[];


	/**
	 * Start a process
	 * 
	 * @return mixed
	 */
	public function start() 
	{
		return $this->scan();
	}


	/**
	 * Stop a process
	 * 
	 * @return mixed
	 */	
	public function stop() 
	{
		throw new ScannerException(ScannerException::METHOD_NOT_IMPLEMENTED);
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


	/**
	 * Scan destenation 
	 */
	abstract public function scan();	
}




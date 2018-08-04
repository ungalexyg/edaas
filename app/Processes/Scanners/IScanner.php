<?php 
namespace App\Processes\Scanners;

use App\Processes\Base\IProcess;


/**
 * Interface Scanner
 */ 
interface IScanner extends IProcess {

	/**
	 * Scan destenation 
	 */
	public function scan();
}




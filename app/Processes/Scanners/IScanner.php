<?php 
namespace App\Processes\Scanners;

use App\Processes\Base\IProcessor;


/**
 * Interface Scanner
 */ 
interface IScanner extends IProcessor {
	
	/**
	 * Scan destenation 
	 */
	public function scan();
}




<?php 
/**
 * --------------------------------------------------------------------------
 *  Has Scanner  
 * --------------------------------------------------------------------------
 * 
 * Embed Scanner instance to the using class
 */ 

namespace App\Processes\Traits;
// use App\Lib\Enums\Channel;
// use App\Lib\Enums\Process;
use App\Exceptions\ProcessorException;



/**
 * Has Scanner Trait 
 */ 
trait HasScanner {


	/**
	 * Scanner instance
	 * 
	 * @var IScanner
	 */
	protected $scanner;	     


	/**
	 * Load Scanner
	 * 
	 * @throws ProcessorException
	 * @return self
	 */	
	protected function loadScanner() 
	{	
        $scanner = 'App\Processes\Scanners\\' . ucwords($this->process) . 'Scanner';

        if (!class_exists($scanner))  throw new ProcessorException(ProcessorException::PROCESSOR_SCANNER_UNDEFINED);

        $this->scanner = new $scanner();			

		$this->scanner->setProcessor($this)->takeKit();

        return $this;
	}	    
}
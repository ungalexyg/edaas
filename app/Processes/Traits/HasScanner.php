<?php 

namespace App\Processes\Traits;

use App\Exceptions\Processors\MainProcessorException;


/**
 * Has Scanner Trait 
 * 
 * Embed Scanner instance to the using class
 */ 
trait HasScanner 
{

	/**
	 * Scanner instance
	 * 
	 * @var IScanner
	 */
	protected $scanner;	     


	/**
	 * Load Scanner
	 * 
	 * @throws MainProcessorException
	 * @return self
	 */	
	protected function loadScanner() 
	{	
        $scanner = 'App\Processes\Scanners\\' . ucwords($this->process) . 'Scanner';

        if (!class_exists($scanner))  throw new MainProcessorException(MainProcessorException::UNDEFINED_SCANNER);

        $this->scanner = new $scanner();			

		$this->scanner->setProcessor($this);

        return $this;
	}	    
}
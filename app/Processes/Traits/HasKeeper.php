<?php 
/**
 * --------------------------------------------------------------------------
 *  Has Keeper  
 * --------------------------------------------------------------------------
 * 
 * Embed Keeper instance to the using class
 */ 

namespace App\Processes\Traits;
// use App\Enums\Channel;
// use App\Enums\Process;
use App\Exceptions\ProcessException;



/**
 * Has Keeper Trait 
 */ 
trait HasKeeper {


	/**
	 * Keepr instance
	 * 
	 * @var IKeeper
	 */
	protected $keeper;	   


	/**
	 * Load Keeper
	 * 
	 * @throws ProcessException
	 * @return self
	 */	
	protected function loadKeeper() 
	{			
		$keeper = 'App\Processes\Keepers\\' . ucwords($this->process) . 'Keeper';

		if (!class_exists($keeper))  throw new ProcessException(ProcessException::UNDEFINED_KEEPER);

		$this->keeper = new $keeper();		

		$this->keeper->setProcessor($this);

		return $this;
	}		    
}
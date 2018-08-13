<?php 
/**
 * --------------------------------------------------------------------------
 *  Has Keeper  
 * --------------------------------------------------------------------------
 * 
 * Embed Keeper instance to the using class
 */ 

namespace App\Processes\Base\Traits;
// use App\Lib\Enums\Channel;
// use App\Lib\Enums\Process;
use App\Exceptions\ProcessorException;



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
	 * @throws ProcessorException
	 * @return self
	 */	
	protected function loadKeeper() 
	{			
		$keeper = 'App\Processes\\Keepers\\' . ucwords($this->process) . 'Keeper';

		if (!class_exists($keeper))  throw new ProcessorException(ProcessorException::PROCESSOR_KEEPER_UNDEFINED);

		$this->keeper = new $keeper();		

		return $this;
	}		    
}
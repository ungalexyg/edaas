<?php 
/**
 * --------------------------------------------------------------------------
 *  Has Process Kit  
 * --------------------------------------------------------------------------
 * 
 * Embed common processes helpers and properties to the using class
 */ 

namespace App\Processes\Base\Traits;


/**
 * Has Process Kit Trait 
 */ 
trait HasProcessKit {


	/**
	 * The current process
	 * 
	 * @var string
	 */
	protected $process;


	/**
	 * The current channel
	 * 
	 * @var string
	 */
	protected $channel;	
	

	/**
	 * Process bag
	 * 
	 * @var array
	 */
	protected $bag=[];	
	
	
	/**
	 * Reference to take kit properties from other instances
	 * 
	 * @param object
	 * @return self
	 */
	protected function takeKit($instance) 
	{
		$this->process 	= &$instance->process 	?? null;
		$this->channel 	= &$instance->channel 	?? null;
		$this->bag 		= &$instance->bag 		?? null;

		return $this;
	} 


	/**
	 * Reference to give kit properties to other instances
	 * 
	 * @param object
	 * @return self
	 */
	protected function giveKit($instance) 
	{
		$instance->process 	= &$this->process 	?? null;
		$instance->channel 	= &$this->channel 	?? null;
		$instance->bag 		= &$this->bag 		?? null;		

		return $this;
	} 	
}
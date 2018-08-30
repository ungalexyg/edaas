<?php 

namespace App\Acts\Base;

use Log;
use App\Acts\Traits\ActSetter;


/**
 * Base Act
 */ 
abstract class BaseAct implements IAct
{
	/**
	 * Act traits
	 */
	use ActSetter;

	
	/**
	 * Validate Act input
	 * 
	 * @return self
	 */	
	abstract public function validate(); 


	/**
	 * Execute an Act
	 * 
	 * @return self
	 */	
	abstract public function execute();	


	/**
	 * Generate Act response
	 * and log Act's message
	 * 
	 * @return array $response
	 */
	public function response() 
	{
		if(!$this->message) 
		{
			$this->message = 'the Act '. $this->key .' completed';
		}

		Log::channel(Log::ACTS)->info($this->message, ['in' => __METHOD__ .':'.__LINE__]);

		return ['message' => $this->message];
	}		
}




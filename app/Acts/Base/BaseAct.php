<?php 

namespace App\Acts\Base;

use Log;


/**
 * Base Act
 */ 
abstract class BaseAct implements IAct
{
	/**
	 * Act key
	 * 
	 * @var null|string
	 */
	public $key;


	/**
	 * Act params
	 * 
	 * @var array
	 */
	public $params = [];
		

	/**
	 * Act message
	 * 
	 * @var null|string
	 */
	public $message;


	/**
	 * Perform an Act
	 * 
	 * @return self
	 */	
	abstract public function perform();	


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




<?php 

namespace App\Processes\Base;


/**
 * Channel Processor Interface 
 */ 
interface IChannelProcessor extends IProcessor
{
	/**
	 * Perform the process
	 * 
	 * @return self
	 */
	public function process();	

		
	/**
	 * Update process timestamp
	 * 
	 * @return self
	 */
	public function stamp();		
}

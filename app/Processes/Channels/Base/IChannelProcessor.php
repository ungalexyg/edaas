<?php 

namespace App\Processes\Channels\Base;

use App\Processes\Base\IProcessor;


/**
 * Channel Processor Interface 
 */ 
interface IChannelProcessor extends IProcessor
{
    /**
     * Scan & fetch data from channel 
     * 
     * @return self
     */
	public function scan();

    
	/**
	 * Store fresh scanned data in the storage
	 * 
	 * @return self
	 */
	public function store();			


    /**
	 *  Publish data from the storage 
	 * 
	 * @return void
     */
	public function publish();	
		

	/**
	 * Generate process response
	 * 
	 * @return array $response
	 */
	public function response();		
}

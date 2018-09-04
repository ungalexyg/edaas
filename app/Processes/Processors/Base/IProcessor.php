<?php 

namespace App\Processes\Processors\Base;


/**
 * Processor Interface 
 */ 
interface IProcessor 
{
	/**
	 * Perform the process
	 * 
	 * @return self
	 */
	public function process();	


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
	 * Update process timestamp
	 * 
	 * @return self
	 */
	public function stamp();		


	/**
	 * Generate process response
	 * 
	 * @return array $response
	 */
	public function response();		

}




<?php 

namespace App\Processes\Adapters\Base;


 /**
  * Adapter Interface
  */
 interface IAdapter {

	/**
	 * Locate initial prospect items
     * 
     * @return mixed
	 */    
    public function fetch(); 

 }






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
    
    
	/**
	 * Set URL
     * 
     * @param string|null $url
     * @return self
	 */  
    public function setUrl($url=null) ; 

 }






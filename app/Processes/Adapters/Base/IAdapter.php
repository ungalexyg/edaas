<?php 

namespace App\Processes\Adapters\Base;


 /**
  * Adapter Interface
  */
 interface IAdapter 
 {

	/**
	 * Fetch destenation
     * 
     * @return array
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






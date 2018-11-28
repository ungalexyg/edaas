<?php 

namespace App\Processes\Channels\Base\Adapters;


 /**
  * Adapter Interface
  */
 interface IAdapter 
 {
	/**
	 * Fetch destenation
     * 
     * @param mixed $reference
     * @return array
	 */    
    public function fetch($reference=null);
    
    
	/**
	 * Set URL
     * 
     * @param string|null $url
     * @return self
	 */  
    public function setUrl($url=null) ; 
 }

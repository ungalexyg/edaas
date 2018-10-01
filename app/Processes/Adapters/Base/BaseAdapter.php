<?php 

namespace App\Processes\Adapters\Base;

use App\Exceptions\Adapters\BaseAdapterException as Exception;


/**
 * Base Adapter
 */
 abstract class BaseAdapter implements IAdapter 
 {

    /**
     * Adapter url
     */
    protected $url;


    /**
     * URL scheme
     * 
     * @var string
     */
    protected $scheme = 'http';


    /**
     * URL domain
     * 
     * @var string
     */
    protected $domain;


    /**
     * Fetched data
     * 
     * @var array
     */
    protected $fetch = [];


	/**
	 * Fetch adapter's targets
     * 
     * @return mixed
	 */        
    abstract public function fetch(); 


	/**
	 * Set URL
     * 
     * @notes
     * $this->path should start with '/' this is the 1st slash aster the domain  
     * e.g : $this->path = '/all-wholesale-products.html';
     * 
     * @param string|null $url
     * @return self
	 */  
    public function setUrl($url=null) 
    {
        if($url) 
        {
            $this->url = $url;
        }
        else 
        {
            if(!$this->domain) throw new Exception(Exception::UNDEFINED_DOMAIN);
    
            $this->query = (!empty($this->query) ? '?' . http_build_query($this->query) : '');
    
            $this->url = $this->scheme . '://' . $this->domain . $this->path . $this->query;
        }

        return $this;
    }
    
 }




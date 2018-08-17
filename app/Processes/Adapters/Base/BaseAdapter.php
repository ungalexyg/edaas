<?php 

namespace App\Processes\Adapters\Base;

use App\Exceptions\AdapterException;


/**
 * Base Adapter
 */
 abstract class BaseAdapter implements IAdapter {

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
	 * Fetch adapter's targets
     * 
     * @return mixed
	 */        
    abstract public function fetch(); 


	/**
	 * Set URL
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
            if(!$this->domain) throw new AdapterException(AdapterException::UNDEFINED_DOMAIN);

            $this->path = ($this->path ? '/' . $this->path : '');
    
            $this->query = (!empty($this->query) ? '?' . http_build_query($this->query) : '');
    
            $this->url = $this->scheme . '://' . $this->domain . $this->path . $this->query;
        }

        return $this;
    }
    
 }




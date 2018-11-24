<?php 

namespace App\Processes\Channles\Base;

use App\Exceptions\BaseChannelAdapterException as Exception;


/**
 * Base Adapter
 */
 abstract class BaseAdapter implements IAdapter 
 {
    /**
     * Target URL scheme
     * 
     * @var string
     */
    protected $scheme = 'https';


    /**
     * Target URL domain
     * 
     * @var string
     */
    protected $domain;


    /**
     * Target URL path
     * 
     * @var string 
     */
    protected $path;
    

    /**
     * Target URL query string
     * 
     * @var array
     */
    protected $query = [];


    /**
     * Full Target URL
     * 
     * @var string
     */
    protected $url;


    /**
     * Fetched data
     * 
     * @var array
     */
    protected $fetch = [];


	/**
	 * Fetch adapter's targets
     * 
     * @param mixed $reference
     * @return mixed
	 */        
    abstract public function fetch($reference=null); 


	/**
	 * Set Target URL scheme
     * 
     * @param string|null $scheme
     * @return self
	 */ 
    public function setScheme($scheme=null) 
    {
        $this->scheme = $scheme;

        return $this;
    }    


	/**
	 * Set Target URL domain
     * 
     * @param string|null $domain
     * @return self
	 */ 
    public function setDomain($domain=null) 
    {
        $this->domain = $domain;

        return $this;
    }    


	/**
	 * Set Target URL path
     * 
     * @param string|null $path
     * @return self
	 */ 
    public function setPath($path=null) 
    {
        $this->path = $path;

        return $this;
    }  


	/**
	 * Set Target URL query
     * 
     * @param array $query
     * @return self
	 */ 
    public function setQuery($query=[]) 
    {
        $this->query = $query;

        return $this;
    }     

    
	/**
	 * Set Target URL
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

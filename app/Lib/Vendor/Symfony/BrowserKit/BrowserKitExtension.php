<?php

/**
 * --------------------------------------------------------------------------
 *  Vendor Extension
 * --------------------------------------------------------------------------
 * Extension src : /vendor/symfony/browser-kit/Client.php
 * Extension namespace : Symfony\Component\BrowserKit\Client
 */ 
namespace App\Lib\Vendor\Symfony\BrowserKit;


/**
 * BrowserKit extension.
 * 
 */
abstract class BrowserKitExtension
{
    
    /**
     * Use vendor's contents as base for extension
     */
    use BrowserKitBase;


    /**
     * Redirects URIs 
     * 
     * @var null|array
     */
    protected $redirects_uris = null;


    /**
     * Get the generated redirects urls during the process
     * 
     * @return array
     */
    public function getRedirectsUris() 
    {    
        if(is_null($this->redirects_uris)) 
        {
            $this->setRedirectsUris();
        }

        return $this->redirects_uris;
    }


    /**
     * Set redirects uris
     * 
     * @return void
     */
    protected function setRedirectsUris() 
    {
        $this->redirects_uris = [];

        if( is_array($this->redirects) ) 
        {
            foreach($this->redirects as $key => $val) 
            {
                $redirect = unserialize($key);
                
                $this->redirects_uris[] = $redirect->getUri();
            }	
        }
    }    
}

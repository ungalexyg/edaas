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
     * @extension 
     * Get the generated redirects urls during the process
     * 
     * @return array
     */
    public function getRedirects() 
    {
        return $this->redirects;
    }
    
}

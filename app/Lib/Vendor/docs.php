
<?php

/**
 * --------------------------------------------------------------------------
 *  Description 
 * --------------------------------------------------------------------------
 * 
 * This directory conatins Vendors Extensions. 
 * The Vendors Extensions serve as connection layer between Vendor's native packadges
 * and application's custom libararies which based on vendors packadges.
 * 
 * e.g:
 *  > Goutte\Client                         // vendor native client
 *  > App\Lib\Vendor\Goutte\GoutteExtension // the connection layer
 *  > App\Lib\Spider\Client                 // app's tailored library
 */


/**
 * --------------------------------------------------------------------------
 *  Stracture 
 * --------------------------------------------------------------------------
 * 
 * Typically, every Vendor Extension should have directory with the vendors name,
 * vendorBase file & vendorExtension file.
 * 
 * e.g : 
 *  App\Lib\Vendor\<Vendorname>\[VendorNameBase].php  // contain a copy of the vendor's client/facde file. shouldn't be edited beside minor access levels that block the flow (private > protected). 
 *  App\Lib\Vendor\<Vendorname>\[VendorNameExtension].php // extend the VendorNameBase for minor customizations & extensions.  
 * 
 * e.g : 
 *  App\Lib\Vendor\Goutte\GoutteBase.php
 *  App\Lib\Vendor\Goutte\GoutteExtension.php
 * 
 */


/**
 * --------------------------------------------------------------------------
 *  Vendor Extension Reference 
 * --------------------------------------------------------------------------
 * Each Vendor Extension should have reference doc block like this one, with the following contents : 
 * 
 * Extending vendor component
 * Extension src : /vendor/guzzlehttp/guzzle/src/Client.php
 * Extension namespace : GuzzleHttp\Client
 * 
 * Resources:
 * http://docs.guzzlephp.org/en/stable/
 * https://github.com/guzzle/guzzle
 */
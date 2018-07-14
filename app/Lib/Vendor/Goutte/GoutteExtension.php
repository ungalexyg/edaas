<?php
/**
 * --------------------------------------------------------------------------
 *  Vendor Extension
 * --------------------------------------------------------------------------
 * Extension src : /vendor/fabpot/goutte/Goutte/Client.php
 * Extension namespace : Goutte\Client
 */
namespace App\Lib\Vendor\Goutte;
use App\Lib\Vendor\Symfony\BrowserKit\BrowserKitExtension; // @extension


/**
 * Goutte client extentsion.
 * 
 */
class GoutteExtension extends BrowserKitExtension
{

    /**
     * Use vendor's contents as base for extension
     */
    use GoutteBase;
 
}

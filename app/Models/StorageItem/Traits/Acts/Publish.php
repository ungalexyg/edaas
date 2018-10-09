<?php

namespace App\Models\StorageItem\Traits\Acts;

use Log;
use App\Models\StorageItem\StorageItem;
use App\Exceptions\Models\StorageItemException as Exception; 

//TODO: upload images during publish

/*
$url = "http://www.google.co.in/intl/en_com/images/srpr/logo1w.png";
$contents = file_get_contents($url);
$name = substr($url, strrpos($url, '/') + 1);
Storage::put($name, $contents);    
*/    



/**
 * Publish Trait 
 * 
 * Storage item publish acts
 */
trait Publish
{
	/**
	 * Publish all storage item records
     * 
     * @return void
	 */
    public function publishAll() 
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__); 
    } 


    /**
     * Publish storage item record
     * 
     * @param StorageItem $storageCategory
     * @return void 
     */
    public function publish(StorageItem $storageItem) 
    {   
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__); 
    }


    // /**
    //  * Unpublish all published storage category records
    //  * 
    //  * @return void
    //  */
    // public function unpublishAll()
    // {
    //     dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);        
    // }    


    // /**
    //  * Unpublish published storage category record
    //  * 
    //  * @param StorageCategory $storageCategory
    //  * @return void
    //  */
    // public function unpublish(StorageCategory $storageCategory)
    // {
    //     dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);                
    // }    
}

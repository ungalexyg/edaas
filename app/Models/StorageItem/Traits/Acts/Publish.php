<?php

namespace App\Models\StorageItem\Traits\Acts;

use Log;
use App\Models\StorageItem\StorageItem;
use App\Exceptions\Models\StorageItemException as Exception; 


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
   
    } 


    /**
     * Publish storage item record
     * 
     * @param StorageItem $storageCategory
     * @return void 
     */
    public function publish(StorageItem $storageItem) 
    {   
        
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

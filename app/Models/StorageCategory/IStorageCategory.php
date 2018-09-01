<?php

namespace App\Models\StorageCategory;


/**
 * Storage Category Interface
 */
interface IStorageCategory 
{
    /**
     * Publish all storage category records
     * 
     * @return void
     */
    public function publishAll();
    

    /**
     * Publish storage category record
     * 
     * @param StorageCategory $storageCategory
     * @return void
     */
    public function publish(StorageCategory $storageCategory);


    /**
     * Unpublish all published storage category records
     * 
     * @return void
     */
    public function unpublishAll();    


    /**
     * Unpublish published storage category record
     * 
     * @param StorageCategory $storageCategory
     * @return void
     */
    public function unpublish(StorageCategory $storageCategory);    
    
    
    /**
     * Aactivate all inactive storage category records
     * 
     * @return void
     */
    public function activateAll();    
    
    
    /**
     * Activate storage category record 
     * 
     * @param StorageCategory $storageCategory
     * @return void
     */
    public function activate(StorageCategory $storageCategory);    
    
    
    /**
     * Deactivate all active storage category records
     * 
     * @return void
     */
    public function deactivateAll();    
    
    
    /**
     * Deactivate storage category record
     * 
     * @param StorageCategory $storageCategory
     * @return void
     */
    public function deactivate(StorageCategory $storageCategory);        
}
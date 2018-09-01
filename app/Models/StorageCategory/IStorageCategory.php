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
     * @return mixed
     */
    public function publishAll();
    

    /**
     * Publish storage category record
     * 
     * @param StorageCategory $StorageCategory
     * @return mixed
     */
    public function publish(StorageCategory $StorageCategory);


    /**
     * Unpublish all published storage category records
     * 
     * @return mixed
     */
    public function unpublishAll();    


    /**
     * Unpublish published storage category record
     * 
     * @param StorageCategory $StorageCategory
     * @return mixed
     */
    public function unpublish(StorageCategory $StorageCategory);    
    
    
    /**
     * Aactivate all inactive storage category records
     * 
     * @return mixed
     */
    public function activateAll();    
    
    
    /**
     * Activate storage category record 
     * 
     * @param StorageCategory $StorageCategory
     * @return mixed
     */
    public function activate(StorageCategory $StorageCategory);    
    
    
    /**
     * Deactivate all active storage category records
     * 
     * @return mixed
     */
    public function deactivateAll();    
    
    
    /**
     * Deactivate storage category record
     * 
     * @param StorageCategory $StorageCategory
     * @return mixed
     */
    public function deactivate(StorageCategory $StorageCategory);        
}
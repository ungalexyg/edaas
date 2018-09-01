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
     * @param int $id
     * @return mixed
     */
    public function publish($id);


    /**
     * Unpublish all published storage category records
     * 
     * @return mixed
     */
    public function unpublishAll();    


    /**
     * Unpublish published storage category record
     * 
     * @param int $id
     * @return mixed
     */
    public function unpublish($id);    
    
    
    /**
     * Aactivate all inactive storage category records
     * 
     * @return mixed
     */
    public function activateAll();    
    
    
    /**
     * Activate storage category record 
     * 
     * @param int $id
     * @return mixed
     */
    public function activate($id);    
    
    
    /**
     * Deactivate all active storage category records
     * 
     * @return mixed
     */
    public function deactivateAll();    
    
    
    /**
     * Deactivate storage category record
     * 
     * @param int $id
     * @return mixed
     */
    public function deactivate($id);        
}
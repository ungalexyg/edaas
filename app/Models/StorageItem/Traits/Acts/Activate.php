<?php

namespace App\Models\StorageCategory\Traits\Acts;

use App\Models\StorageCategory\StorageCategory;
use App\Exceptions\Models\StorageCategoryException as Exception; 


/**
 * Activate Trait 
 * 
 * Storage category activate acts
 */
trait Activate
{
    /**
     * Activate Storage Category
     * 
     * @return void
     */
    public function activateAll()
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }


    /**
     * Activate Storage Category
     * 
     * @param StorageCategory $storageCategory
     * @return void
     */
    public function activate(StorageCategory $storageCategory)
    {        
        if(!isset($storageCategory->id)) throw new Exception(Exception::ENTITY_NOT_FOUND . ' | act: ' . $this->method . ' | id:' . $id);

        if($storageCategory->active != 1) 
        {
            $storageCategory->active = 1;

            $storageCategory->save();

            $this->messages[] = 'Storage category ' . $storageCategory->id . ' has been activated successfully.';            

            $this->affected[] = $storageCategory;            
        }
        else 
        {
            $this->messages[] = 'Storage category ' . $storageCategory->id . ' is already active.';            
        }
    }


    /**
     * Deactivate all active storage category records
     * 
     * @return void
     */
    public function deactivateAll() 
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }    
    
    
    /**
     * Deactivate storage category record
     * 
     * @param StorageCategory $StorageCategory
     * @return void
     */
    public function deactivate(StorageCategory $StorageCategory)
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }            
}
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
     * @param StorageCategory $StorageCategory
     * @return void
     */
    public function activate(StorageCategory $storage_category)
    {
        $storage_category = $this->entity();
        
        if(!isset($storage_category->id)) throw new Exception(Exception::ENTITY_NOT_FOUND . ' | act: ' . $this->method . ' | id:' . $id);

        if($storage_category->active != 1) 
        {
            $storage_category->active = 1;

            $storage_category->save();

            $this->messages[] = 'Storage category ' . $storage_category->id . ' activated.';            

            $this->affected[] = $storage_category;            
        }
        else 
        {
            $this->messages[] = 'Storage category ' . $storage_category->id . ' is already active.';            
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
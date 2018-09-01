<?php

namespace App\Models\StorageCategory\Traits\Acts;

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
     * @return self
     */
    protected function activate()
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

        return $this;
    }

  
    /**
     * Activate Storage Category
     * 
     * @return self
     */
    protected function activateAll()
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }
}
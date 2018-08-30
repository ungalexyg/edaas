<?php

namespace App\Models\StorageCategory\Traits;

use App\Exceptions\Models\StorageCategoryException as Exception; 




/**
 * Storage Category Acts
 */
trait Acts
{
    /**
     * Publish Storage Category
     * 
     * @return self
     */
    public function activate()
    {
        $id = $this->input->id;

        $storage_category = $this->find($id);
        
        if(!isset($storage_category->id)) throw new Exception(Exception::ENTITY_NOT_FOUND . ' | act: ' . $this->act . ' | id:' . $id);

        if($storage_category->active != 1) 
        {
            $storage_category->active = 1;

            $storage_category->save();

            $this->response[] = 'Storage category ' . $id . ' activated.';            
        }
        else 
        {
            $this->response[] = 'Storage category ' . $id . ' is already active.';            
        }

        return $this;
    }
}




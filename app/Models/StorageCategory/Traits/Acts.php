<?php

namespace App\Models\StorageCategory\Traits;

use App\Exceptions\Models\StorageCategoryException as Exception; 


/**
 * Storage Category Acts
 */
trait Acts
{
    /**
     * Activate Storage Category
     * 
     * @return self
     */
    public function actActivate()
    {
        $storage_category = $this->entity ?? (isset($this->input->id) ? $this->find($this->input->id) : null) ;
        
        if(!isset($storage_category->id)) throw new Exception(Exception::ENTITY_NOT_FOUND . ' | act: ' . $this->method . ' | id:' . $id);

        if($storage_category->active != 1) 
        {
            $storage_category->active = 1;

            $storage_category->save();

            $this->response[] = 'Storage category ' . $storage_category->id . ' activated.';            
        }
        else 
        {
            $this->response[] = 'Storage category ' . $storage_category->id . ' is already active.';            
        }

        return $this;
    }


    public function actPublish($id) 
    {   
        static::perform('publish', $id);
    }


	/**
	 * Publish Storage Category
	 * 
	 */
    public function actPublishAll() 
    {
        $storages = StorageCategory::unpublished()->get(); 

        foreach($storages as $storage_category) 
        {
            $this->publishSingle($storage_category);
        }

        $this->publishLinkParents(); 

        Log::channel(Log::CATEGORIES_PUBLISHER)->info('categories publisher completed publish process', ['in' => __METHOD__ .':'.__LINE__]);                
    }    
}
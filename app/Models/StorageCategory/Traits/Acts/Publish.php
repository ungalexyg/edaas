<?php

namespace App\Models\StorageCategory\Traits\Acts;

use App\Exceptions\Models\StorageCategoryException as Exception; 


/**
 * Publish Trait 
 * 
 * Storage category publish acts
 */
trait Publish
{

    
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
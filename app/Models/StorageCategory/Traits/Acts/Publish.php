<?php

namespace App\Models\StorageCategory\Traits\Acts;

use App\Models\Category\Category;
use App\Exceptions\Models\StorageCategoryException as Exception; 


/**
 * Publish Trait 
 * 
 * Storage category publish acts
 */
trait Publish
{
    /**
     * Publish storage category record
     * 
     * @return self
     */
    protected function actPublish() 
    {   
        $storage_category = $this->entity ?? (isset($this->input->id) ? $this->find($this->input->id) : null) ;

        // if there's a Category with the given storage_category_id, set the rest of the data to the 2nd given array, otherwise create it.
        $category = Category::updateOrCreate(
            [
                'storage_category_id' => $storage_category->id
            ], [
                'title' => $storage_category->title, 
                'description' => $storage_category->description
            ]
        );

        // link the fresh category to the storage_category 
        $storage_category->category_id = $category->id;

        // mark the storage record as published to updated the sourced category with the latest fetched items
        $storage_category->published = 1;

        // mark the storage record as active for items process
        $storage_category->active = (($this->config['auto_active'] ?? false) ? 1 : 0); 

        // save the updates
        $storage_category->save();

        return $this;           
    }


	/**
	 * Publish Storage Category
	 */
    protected function actPublishAll() 
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
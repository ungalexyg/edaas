<?php

namespace App\Models\StorageCategory\Traits\Acts;

use App\Models\Category\Category;
use App\Models\StorageCategory\StorageCategory;
use App\Exceptions\Models\StorageCategoryException as Exception; 
use Log;

/**
 * Publish Trait 
 * 
 * Storage category publish acts
 */
trait Publish
{
	/**
	 * Publish all storage category records
     * 
     * @return array
	 */
    final public function publishAll() 
    {
        $storages = StorageCategory::unpublished()->get(); 

        foreach($storages as $storage_category) 
        {
            $this->publish($storage_category);
        }

        $this->publishLinkParents(); 

        Log::channel(Log::STORAGE_CATEGORY)->info('StorageCategory@publishAll completed', ['in' => __METHOD__ .':'.__LINE__]);                

        return $this->response();         
    } 


    /**
     * Publish storage category record
     * 
     * @param StorageCategory $storage_category
     * @return array 
     */
    final public function publish(StorageCategory $storage_category) 
    {   
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

        // save the updates
        $storage_category->save();

        $this->affected[] = [$storage_category, $category];            

        return $this->response();           
    }


    /**
     * Link published cateogires parents 
     * based on channel's hirarchy in storage category
     * 
     * @see App\Models\Category
     * @return void
     */
    protected function publishLinkParents() 
    {
        // get organic & orphan categories
        $categories = Category::organic()->orphan()->get();

        foreach($categories as $category) 
        {
            $storage_category = StorageCategory::withParent($category->storage_category_id)->first();
            
            if(isset($storage_category->parent->id)) // if it has a parent
            {
                // check if the parent already published
                $parent_category = Category::where('storage_category_id', '=', $storage_category->parent->id)->first();

                // if it's published, assign it to the child now
                if(isset($parent_category->id)) 
                {
                    $category->parent_category_id = $parent_category->id;
    
                    $category->save();
                }
            }
            elseif($storage_category->parent_channel_category_id == 0) // if the storage record is parent category in the channel
            {
                $category->parent_category_id = 0; // update the published category also as parent category
    
                $category->save();                
            }
        }  
        
        Log::channel(Log::STORAGE_CATEGORY)->info('StorageCategory@publishLinkParents completed', ['in' => __METHOD__ .':'.__LINE__]);                
    }  
}
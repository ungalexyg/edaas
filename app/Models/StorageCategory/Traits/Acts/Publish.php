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
     * @return void
	 */
    public function publishAll() 
    {
        $storages = StorageCategory::unpublished()->get(); 

        foreach($storages as $storageCategory) 
        {
            $this->publish($storageCategory);
        }

        $this->publishLinkParents(); 

        Log::channel(Log::STORAGE_CATEGORY)->info('StorageCategory@publishAll completed', []);                
   
    } 


    /**
     * Publish storage category record
     * 
     * @param StorageCategory $storageCategory
     * @return void 
     */
    public function publish(StorageCategory $storageCategory) 
    {   
        // if there's a Category with the given storage_category_id, set the rest of the data to the 2nd given array, otherwise create it.
        $category = Category::updateOrCreate(
            [
                'storage_category_id' => $storageCategory->id
            ], [
                'title' => $storageCategory->title, 
                'description' => $storageCategory->description
            ]
        );

        if($storageCategory->published != 1) 
        {
            // link the fresh category to the storage_category 
            $storageCategory->category_id = $category->id;

            // mark the storage record as published to updated the sourced category with the latest fetched items
            $storageCategory->published = 1;

            // save the updates
            $storageCategory->save();

            $this->messages[] = 'Storage category ' . $storageCategory->id . ' has been published successfully';            

            $this->affected[] = [$storageCategory, $category]; 
        }
        else 
        {
            $this->messages[] = 'Storage category ' . $storageCategory->id . ' is already published';            
        }           
    }


    /**
     * Unpublish all published storage category records
     * 
     * @return void
     */
    public function unpublishAll()
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);        
    }    


    /**
     * Unpublish published storage category record
     * 
     * @param StorageCategory $storageCategory
     * @return void
     */
    public function unpublish(StorageCategory $storageCategory)
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);                
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
        $affected = [];

        // get organic & orphan categories
        $categories = Category::organic()->orphan()->get();

        foreach($categories as $category) 
        {
            $storageCategory = StorageCategory::withParent($category->storage_category_id)->first();
            
            if(isset($storageCategory->parent->id)) // if it has a parent
            {
                // check if the parent already published
                $parent_category = Category::where('storage_category_id', '=', $storageCategory->parent->id)->first();

                // if it's published, assign it to the child now
                if(isset($parent_category->id)) 
                {
                    $category->parent_category_id = $parent_category->id;
    
                    $category->save();
                }
            }
            elseif($storageCategory->parent_channel_category_id == 0) // if the storage record is parent category in the channel
            {
                $category->parent_category_id = 0; // update the published category also as parent category
    
                $category->save();                
            }

            $affected[] = ['storage_category_id' => $storageCategory->id , 'category_id' => $category->id];
        }  
        
        Log::channel(Log::STORAGE_CATEGORY)->info('StorageCategory@publishLinkParents completed', ['affected' => $affected]);                
    }  
}

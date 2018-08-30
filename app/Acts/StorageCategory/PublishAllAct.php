<?php

namespace App\Acts\StorageCategory;

use App\Enums\Acts;
use App\Models\StorageCategory;
use App\Acts\Base\BaseAct;
use App\Exceptions\Acts\ActException;

/**
 * Publish Storage Category Act
 */
class PublishAct extends BaseAct
{
	/**
	 * Publish data from the storage to the public tables
	 * 
	 */
    public function publish() 
    {
        $storages = StorageCategory::unpublished()->get(); 

        foreach($storages as $storage_category) 
        {
            $this->publishSingle($storage_category);
        }

        $this->publishLinkParents(); 

        Log::channel(Log::CATEGORIES_PUBLISHER)->info('categories publisher completed publish process', ['in' => __METHOD__ .':'.__LINE__]);                
    }


	/**
	 * Publish single record from the storage 
	 * 
     * @see App\Observers\StorageCategoryObserver
     * @param StorageCategory $storage_category
	 * @return Category $category // the published category
	 */
    public function publishSingle(StorageCategory $storage_category) 
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

        // mark the storage record as active for items process
        $storage_category->active = (($this->config['auto_active'] ?? false) ? 1 : 0); 

        // save the updates
        $storage_category->save();

        return $category;        
    }     
    
    
    /**
     * Link published cateogires parents 
     * based on channel's hirarchy in storage category
     * 
     * @see App\Models\Category
     * @return void
     */
    public function publishLinkParents() 
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
        
        Log::channel(Log::CATEGORIES_PUBLISHER)->info('completed link categories parents', ['in' => __METHOD__ .':'.__LINE__]);        
    }   
}

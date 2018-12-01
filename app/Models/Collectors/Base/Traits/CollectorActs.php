<?php

namespace App\Models\Collectors\Base\Traits;

use App\Exceptions\ModelException as Exception; 
use App\App\Models\Collectors\Base\ICollector;


/**
 * Collector models acts
 */
trait CollectorActs
{
    
    ################################################
    # Store
    ################################################


    /**
     * Store a batch of records
     * 
     * @param array $batch
     * @return void
     */
    public function storeBatch(array $batch)
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);   
    }
    

    /**
     * Store single storage category
     * 
     * @param array $input
     * @return void
     */
    public function store($input) 
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }   


    ################################################
    # Activate / Deactivate
    ################################################


    /**
     * Activate all processable records
     * 
     * @return void
     */
    public function activateAll()
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }


    /**
     * Activate single processable record
     * 
     * @param ICollector $model 
     * @return void
     */
    public function activate(ICollector $model)
    {       
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);        
        
        // if(!isset($storageCategory->id)) throw new Exception(Exception::ENTITY_NOT_FOUND . ' | act: ' . $this->method . ' | id:' . $id);

        // if($storageCategory->active != 1) 
        // {
        //     $storageCategory->active = 1;

        //     $storageCategory->save();

        //     $this->messages[] = 'Storage category ' . $storageCategory->id . ' has been activated successfully.';            

        //     $this->affected[] = $storageCategory;            
        // }
        // else 
        // {
        //     $this->messages[] = 'Storage category ' . $storageCategory->id . ' is already active.';            
        // }
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
     * @param ICollector $model 
     * @return void
     */
    public function deactivate(ICollector $model)
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }  
    
    
    ################################################
    # Publish / Unpublish
    ################################################


	/**
	 * Publish all storage category records
     * 
     * @return void
	 */
    public function publishAll() 
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);

        // $storages = StorageCategory::unpublished()->get(); 

        // foreach($storages as $storageCategory) 
        // {
        //     $this->publish($storageCategory);
        // }

        // $this->publishLinkParents(); 

        // Log::channel(Log::STORAGE_CATEGORY)->info('StorageCategory@publishAll completed', ['published' => count($storages)]);                
   
    } 


    /**
     * Publish storage category record
     * 
     * @param ICollector $model 
     * @return void 
     */
    public function publish(ICollector $model) 
    {   

        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);

        // // if there's a Category with the given storage_category_id, set the rest of the data to the 2nd given array, otherwise create it.
        // $category = Category::updateOrCreate(
        //     [
        //         'storage_category_id' => $storageCategory->id
        //     ], [
        //         'title' => $storageCategory->title, 
        //         'description' => $storageCategory->description
        //     ]
        // );

        // if($storageCategory->published != 1) 
        // {
        //     // link the fresh category to the storage_category 
        //     $storageCategory->category_id = $category->id;

        //     // mark the storage record as published to updated the sourced category with the latest fetched items
        //     $storageCategory->published = 1;

        //     // save the updates
        //     $storageCategory->save();

        //     $this->messages[] = 'Storage category ' . $storageCategory->id . ' has been published successfully';            

        //     $this->affected[] = [$storageCategory, $category]; 
        // }
        // else 
        // {
        //     $this->messages[] = 'Storage category ' . $storageCategory->id . ' is already published';            
        // }           
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
     * @param ICollector $model 
     * @return void
     */
    public function unpublish(ICollector $model)
    {
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);                
    }    


    // /**
    //  * Link published cateogires parents 
    //  * based on channel's hirarchy in storage category
    //  * 
    //  * @see App\Models\Category
    //  * @return void
    //  */
    // protected function publishLinkParents() 
    // {
    //     dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);     

    //     // $affected = [];

    //     // // get organic & orphan categories
    //     // $categories = Category::organic()->orphan()->get();

    //     // foreach($categories as $category) 
    //     // {
    //     //     $storageCategory = StorageCategory::withParent($category->storage_category_id)->first();
            
    //     //     if(isset($storageCategory->parent->id)) // if it has a parent
    //     //     {
    //     //         // check if the parent already published
    //     //         $parent_category = Category::where('storage_category_id', '=', $storageCategory->parent->id)->first();

    //     //         // if it's published, assign it to the child now
    //     //         if(isset($parent_category->id)) 
    //     //         {
    //     //             $category->parent_category_id = $parent_category->id;
    
    //     //             $category->save();
    //     //         }
    //     //     }
    //     //     elseif($storageCategory->parent_channel_category_id == 0) // if the storage record is parent category in the channel
    //     //     {
    //     //         $category->parent_category_id = 0; // update the published category also as parent category
    
    //     //         $category->save();                
    //     //     }

    //     //     $affected[] = ['storage_category_id' => $storageCategory->id , 'category_id' => $category->id];
    //     // }  
        
    //     // Log::channel(Log::STORAGE_CATEGORY)->info('StorageCategory@publishLinkParents completed', ['affected' => $affected]);                
    // }     
}
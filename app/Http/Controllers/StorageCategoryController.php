<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Act;
// use App\Models\Category;
// use App\Lib\Helpers\LaraHelpers as Lara;
use App\Http\Controllers\Traits\ResourceBoilerplate;
use App\Models\StorageCategory\StorageCategory;
use App\Models\Category\Category;

class StorageCategoryController extends BaseController
{
    /**
     * Controller traits
     */
    use ResourceBoilerplate;


    /**
     * Publish all storage category records
     * 
     * @return mixed
     */
    public function publishAll() 
    {   
        $result = StorageCategory::perform('publishAll');

        return $result;
    }     


    /**
     * Publish storage category record
     * 
     * @param int $id
     * @return mixed
     */
    public function publish($id) 
    {   
        $result = StorageCategory::perform('publish', StorageCategory::find($id)); // full flow
        $result = StorageCategory::publish(StorageCategory::find($id)); // minimal action

        return $result;
    }     


    /**
     * Unpublish all published storage category records
     * 
     * @return mixed
     */
    public function unpublishAll() 
    {   
        $result = StorageCategory::perform('unpublishAll');

        return $result;
    } 


    /**
     * Unpublish published storage category record
     * 
     * @param int $id
     * @return mixed
     */
    public function unpublish($id) 
    {   
        $result = StorageCategory::perform('unpublish', StorageCategory::find($id));

        return $result;
    }
    
    
    /**
     * Aactivate all inactive storage category records
     * 
     * @return mixed
     */
    public function activateAll() 
    {   
        $result = StorageCategory::perform('activateAll');

        return $result;
    } 


    /**
     * Activate storage category record 
     * 
     * @param int $id
     * @return mixed
     */
    public function activate($id) 
    {   
        $result = StorageCategory::perform('activate', StorageCategory::find($id));
        
        return $result;
    } 


    /**
     * Deactivate all active storage category records
     * 
     * @return mixed
     */
    public function deactivateAll() 
    {   
        $result = StorageCategory::perform('deactivateAll');

        return $result;
    }     
    
    /**
     * Deactivate storage category record for items process
     * 
     * @param int $id
     * @return mixed
     */
    public function deactivate($id) 
    {   
        $result = StorageCategory::perform('deactivate', StorageCategory::find($id));

        return $result;
    }  
}
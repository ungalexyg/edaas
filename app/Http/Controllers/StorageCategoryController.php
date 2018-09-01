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
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }     


    /**
     * Publish storage category record
     * 
     * @param int $id
     * @return mixed
     */
    public function publish($id) 
    {   
        $result = StorageCategory::publish(StorageCategory::PUBLISH, ['id' => $id, 'active' => 1]);

        return $result;
    }     


    /**
     * Unpublish all published storage category records
     * 
     * @return mixed
     */
    public function unpublishAll() 
    {   
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    } 


    /**
     * Unpublish published storage category record
     * 
     * @param int $id
     * @return mixed
     */
    public function unpublish($id) 
    {   
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }
    
    
    /**
     * Aactivate all inactive storage category records
     * 
     * @return mixed
     */
    public function activateAll() 
    {   
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    } 


    /**
     * Activate storage category record 
     * 
     * @param int $id
     * @return mixed
     */
    public function activate($id) 
    {   
        $result = StorageCategory::perform(StorageCategory::ACTIVATE, ['id' => $id]);
        
        return $result;
    } 


    /**
     * Deactivate all active storage category records
     * 
     * @return mixed
     */
    public function deactivateAll() 
    {   
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }     
    
    /**
     * Deactivate storage category record for items process
     * 
     * @param int $id
     * @return mixed
     */
    public function deactivate($id) 
    {   
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
    }  
}
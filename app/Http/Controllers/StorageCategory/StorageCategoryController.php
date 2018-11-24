<?php

namespace App\Http\Controllers\StorageCategory;

use App\Http\Controllers\Base\BaseController;
use App\Models\StorageCategory\StorageCategory;
use App\Exceptions\ControllerException as Exception;


/**
 * Storage Category Controller
 */
class StorageCategoryController extends BaseController
{
    /**
     * Controller traits
     */
    use StorageCategoryResource;



    /**
     * Publish all storage category records
     * 
     * @return mixed
     */
    public function publishAll() 
    {   
        //dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);
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
        // dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);        
        $result = StorageCategory::perform('publish', StorageCategory::find($id)); 
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
        // $result = StorageCategory::perform('unpublishAll');
        // return $result;
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
        // $result = StorageCategory::perform('unpublish', StorageCategory::find($id));
        // return $result;
    }
    
    
    /**
     * Aactivate all inactive storage category records
     * 
     * @return mixed
     */
    public function activateAll() 
    {   
        //dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);                
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
        //dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);                
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
        dd(Exception::METHOD_NOT_IMPLEMENTED, __METHOD__);                
        // $result = StorageCategory::perform('deactivateAll');
        // return $result;
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
        // $result = StorageCategory::perform('deactivate', StorageCategory::find($id));
        // return $result;
    }       
}

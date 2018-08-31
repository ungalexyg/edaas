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
     * Activate storage category
     */
    public function activate($id) 
    {   
        //$storage_category = StorageCategory::find($id);

        $result = StorageCategory::perform('activate', ['id' => $id]);
        
        return $result;
    } 


    /**
     * Publish storage category
     */
    public function publish($id) 
    {   
        $result = StorageCategory::publish(['id' => $id]);

        return $result;
    }     
}
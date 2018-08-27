<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Act;
use App\Http\Controllers\Traits\ResourceBoilerplate;



class StorageCategoryController extends Controller
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
        $response = Act::do(Act::STORAGE_CATEGORY_ACTIVATE, ['id' => $id]);
        
        dd($response);
    } 
}
<?php

namespace App\Http\Controllers;

use App\Enums\Processes;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StorageCategory;
use App\Processes\Processors\Base\MainProcessor as Processor;



class ActionController extends Controller
{
    /**
     * Perform action
     */
    public function action($action, $params) 
    {
        dd($params);

       $response = (new Action)->do($action, $params);

       dd($response);
    }




}
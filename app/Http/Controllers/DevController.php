<?php

namespace App\Http\Controllers;

use App\Enums\Processes;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StorageCategory;
use App\Processes\Processors\Base\MainProcessor as Processor;




class DevController extends Controller
{
    /**
     * Process Categories 
     */
    public function categories() 
    {
       (new Processor)->run(Processes::CATEGORIES);
    }


    /**
     * Process Items
     */
    public function items() 
    {
       (new Processor)->run(Processes::ITEMS);
    }    
}

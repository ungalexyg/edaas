<?php

namespace App\Http\Controllers;

use App\Enums\Processes;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StorageCategory;
use App\Processes\Processors\Base\MainProcessor as Processor;




class DevController extends Controller
{


    ########################################
    # Processes
    ########################################

    public function categories() 
    {
       (new Processor)->run(Processes::CATEGORIES);
    }






   
}

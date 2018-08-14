<?php

namespace App\Http\Controllers;

use App\Lib\Enums\Process;
use Illuminate\Http\Request;
use App\Processes\Processors\Base\BaseProcessor as Processor;




class DevController extends Controller
{


    ########################################
    # Processes
    ########################################

    public function categories() 
    {
        
        //(new Processor(Process::CATEGORIES))->process();

        //(new CategoriesScanner)->process();

        (new Processor)->run(Process::CATEGORIES);

    
    }






   
}

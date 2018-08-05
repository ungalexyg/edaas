<?php

namespace App\Http\Controllers;

use App\Lib\Enums\Process;
use Illuminate\Http\Request;
use App\Processes\Base\Processor;



class DevController extends Controller
{


    ########################################
    # Processes
    ########################################

    public function categories() 
    {
        // working on Ali get categories process
        $process = new Processor(Process::CATEGORIES);

        $process->scanner()->start();
        
        $process->keeper()->start();
        
        $process->watcher()->start();


    
    }






   
}

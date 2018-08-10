<?php

namespace App\Http\Controllers;

use App\Lib\Enums\Process;
use App\Lib\Enums\Channel;
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
        $process = (new Processor(Process::CATEGORIES, Channel::ALIEXPRESS))->process();

        // $process->scanner()->start();
        
        //$process->keeper()->start();
        
        //$process->watcher()->start();


    
    }






   
}

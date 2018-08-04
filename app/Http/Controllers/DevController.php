<?php

namespace App\Http\Controllers;

use App\Lib\Enums\Process;
use Illuminate\Http\Request;
use App\Processes\Scanners\BaseScanner as Scanner;


class DevController extends Controller
{


    ########################################
    # Processes
    ########################################

    public function categories() 
    {
        // working on Ali get categories process
        
        (new Scanner(Process::CATEGORIES))->start();

    }






   
}

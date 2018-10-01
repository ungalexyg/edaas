<?php

namespace App\Http\Controllers\Process;

use App\Enums\ProcessEnum as Processes;
use App\Http\Controllers\Base\BaseController;
use App\Models\StorageCategory\StorageCategory;
use App\Processes\Processors\Base\MainProcessor as Processor;


/**
 * Process Controller
 */
class ProcessController extends BaseController
{
    /**
     * Process Categories 
     */
    public function categories() 
    {
       $response = (new Processor)->run(Processes::CATEGORIES);

       return $response;
    }


    /**
     * Process Items
     */
    public function items() 
    {
        $response = (new Processor)->run(Processes::ITEMS);
       
        return $response;
    }    
}

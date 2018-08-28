<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StorageCategory;
use App\Enums\ProcessEnum as Processes;
use App\Processes\Processors\Base\MainProcessor as Processor;



/*
TODO:

for categoires and items 
https://laracasts.com/discuss/channels/eloquent/dynamic-table-name

*/
class ProcessController extends BaseController
{
    /**
     * Process Categories 
     */
    public function categories() 
    {
       $response = (new Processor)->run(Processes::CATEGORIES);

       dd($response);
    }


    /**
     * Process Items
     */
    public function items() 
    {
        $response = (new Processor)->run(Processes::ITEMS);
       
        dd($response);
    }    
}
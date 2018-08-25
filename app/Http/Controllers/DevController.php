<?php

namespace App\Http\Controllers;

use App\Enums\Processes;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StorageCategory;
use App\Processes\Processors\Base\MainProcessor as Processor;



/*
TODO:

for categoires and items 
https://laracasts.com/discuss/channels/eloquent/dynamic-table-name

*/
class DevController extends Controller
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
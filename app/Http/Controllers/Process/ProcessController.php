<?php

namespace App\Http\Controllers\Process;

use App\Http\Controllers\Base\BaseController;
use App\Processes\Processors\Base\MainProcessor as Processor;
use App\Enums\ProcessEnum as Processes;



/*
TODO:

Check option to work with multiple tables per channel
e.g : 
storage_category_1 (chhanel_id - ali) 
storage_category_2 (chhanel_id - amazon)
storage_category_3 (chhanel_id - ebay)

storage_items_1 (chhanel_id - ali) 
storage_items_2 (chhanel_id - amazon)
storage_items_3 (chhanel_id - ebay)

work with model :

$product = new Product;
$product->getTable(); // products
$product->setTable('oooops');
$product->get(); // select * from oooops
$product->first(); // select * from oooops limit 1
etc...    

https://stackoverflow.com/questions/27417794/update-the-table-name-at-runtime-not-working-laravel-eloquent-orm
https://laracasts.com/discuss/channels/eloquent/dynamic-table-name
*/


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
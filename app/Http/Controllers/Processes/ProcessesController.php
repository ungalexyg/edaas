<?php

namespace App\Http\Controllers\Processes;

use App\Enums\ProcessEnum as Processes;
use App\Models\StorageItem\StorageItem;
use App\Http\Controllers\Base\BaseController;
use App\Models\StorageCategory\StorageCategory;
use App\Processes\Processors\Base\MainProcessor as Processor;


/**
 * Processes Controller
 */
class ProcessesController extends BaseController
{
    /**
     * Process Categories 
     * 
     * @param string $process
     * @param string $channel
     * @return mixed $response
     */
    public function channels($channel, $process) 
    {
       $response = (new Processor)->run($channel, $process);

       return $response;
    }

    // /**
    //  * Process Items
    //  */
    // public function items() 
    // {
    //     // $channel_item_id = 32885272594;

    //     // $item_data = [
    //     //     "title" => "Rogi Summer Lace Chiffon Blouse Women Long Sleeve V-Neck Casual Shirt Tops Elegant Office Ladies Blouses Blusa Mujer Plus Size",
    //     //     "path" => "/item/Rogi-Summer-Lace-Chiffon-Blouse-Women-Long-Sleeve-V-Neck-Casual-Shirt-Tops-Elegant-Office-Ladies/32885272594.html",
    //     //     "img_src" => "//ae01.alicdn.com/kf/HTB1uMrEKf5TBuNjSspcq6znGFXap/Rogi-Summer-Lace-Chiffon-Blouse-Women-Long-Sleeve-V-Neck-Casual-Shirt-Tops-Elegant-Office-Ladies.jpg_220x220.jpg",
    //     //     "price_min" => 7.48,
    //     //     "price_max" => 8.48,
    //     //     "orders" => "374",
    //     //     "storage_category_id" => 3
    //     // ];               
    //     // $storageItem = StorageItem::updateOrCreate(['channel_item_id' => $channel_item_id], $item_data);

    //     // dd($storageItem);

    //     $response = (new Processor)->run(Processes::ITEMS);
       
    //     return $response;
    // }    
}

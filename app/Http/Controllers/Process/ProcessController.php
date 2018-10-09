<?php

namespace App\Http\Controllers\Process;

use App\Enums\ProcessEnum as Processes;
use App\Models\StorageItem\StorageItem;
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

    /*

    SQLSTATE[22003]: Numeric value out of range: 1264 Out of range value for column 'channel_item_id' at row 1 
    (SQL: insert into `storage_items` (
        `channel_item_id`, `title`, `path`, `img_src`, `price_min`, `price_max`, `orders`, `storage_category_id`, `updated_at`, `created_at`) 
        values (
        32885272594, Rogi Summer Lace Chiffon Blouse Women Long Sleeve V-Neck Casual Shirt Tops Elegant Office Ladies Blouses Blusa Mujer Plus Size, /item/Rogi-Summer-Lace-Chiffon-Blouse-Women-Long-Sleeve-V-Neck-Casual-Shirt-Tops-Elegant-Office-Ladies/32885272594.html, //ae01.alicdn.com/kf/HTB1uMrEKf5TBuNjSspcq6znGFXap/Rogi-Summer-Lace-Chiffon-Blouse-Women-Long-Sleeve-V-Neck-Casual-Shirt-Tops-Elegant-Office-Ladies.jpg_220x220.jpg, 7.48, 8.48, 374, 3, 2018-10-09 07:41:25, 2018-10-09 07:41:25))
*/

    /**
     * Process Items
     */
    public function items() 
    {
        // $channel_item_id = 32885272594;

        // $item_data = [
        //     "title" => "Rogi Summer Lace Chiffon Blouse Women Long Sleeve V-Neck Casual Shirt Tops Elegant Office Ladies Blouses Blusa Mujer Plus Size",
        //     "path" => "/item/Rogi-Summer-Lace-Chiffon-Blouse-Women-Long-Sleeve-V-Neck-Casual-Shirt-Tops-Elegant-Office-Ladies/32885272594.html",
        //     "img_src" => "//ae01.alicdn.com/kf/HTB1uMrEKf5TBuNjSspcq6znGFXap/Rogi-Summer-Lace-Chiffon-Blouse-Women-Long-Sleeve-V-Neck-Casual-Shirt-Tops-Elegant-Office-Ladies.jpg_220x220.jpg",
        //     "price_min" => 7.48,
        //     "price_max" => 8.48,
        //     "orders" => "374",
        //     "storage_category_id" => 3
        // ];               
        // $storageItem = StorageItem::updateOrCreate(['channel_item_id' => $channel_item_id], $item_data);

        // dd($storageItem);

        $response = (new Processor)->run(Processes::ITEMS);
       
        return $response;
    }    
}

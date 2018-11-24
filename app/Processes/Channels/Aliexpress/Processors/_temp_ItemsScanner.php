<?php 

namespace App\Processes;

use App\Lib\Processes\Base\BaseProcess;
use App\Lib\Embed\Embed;
use App\Processes\Scanner;
use App\Processes\Adapters\Google\GoogleAdapter;


/**
 * Scanner Process 
 * 
 * Locat raw data & "Prospect Items" from given "Prospects Channels", 
 * then pass them to the Keeper for forther handling and storage.
 */ 
class ItemsScanner extends BaseProcess 
{

    /**
     * Img src 
     * 
     * @var string
     */
    protected $img_src = "https://ae01.alicdn.com/kf/HTB1RrfMjCYTBKNjSZKbq6xJ8pXai/T-Shirt-Women-Summer-Short-Sleeve-V-Neck-t-shirt-Female-Cactus-Funny-Letter-Print-T.jpg";    


	/**
	 * Scan Prospect Items
	 * 
	 * - visit each category in Ali
	 * - grab products by newest with orders count 
	 * - store the 'category-newest'dataset
	 * - run the process every 4 hours to compare changes per item
	 * - products with X orders increased will be stored as 'Prospects' for forther treatment  
	 */
    public function ScanItems()
    {

    }


    /**
     * Example google custom search
     */
    public function search()
    {
        $res = (new GoogleAdapter)->gcseSearch("Baby Groot Flowerpot");
        
        echo $res->getBody();
    }

    /**
     * Example reverse image search
     */
    public function imageSearch()
    {
        $this->img_src = "https://ae01.alicdn.com/kf/HTB1RrfMjCYTBKNjSZKbq6xJ8pXai/T-Shirt-Women-Summer-Short-Sleeve-V-Neck-t-shirt-Female-Cactus-Funny-Letter-Print-T.jpg";

        // add extra query params
        $query = [
			//'q' => 'site:bellelily.com', // optional, get results for that image only in specific site
        ];
        
        $results = (new GoogleAdapter)->grisSearch($img_src, $query);
        
        dd($results);
    }

}




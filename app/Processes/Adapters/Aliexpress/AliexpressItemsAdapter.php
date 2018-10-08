<?php 

namespace App\Processes\Adapters\Aliexpress;


use Log;
use App\Models\StorageCategory\StorageCategory;
use App\Lib\Vendor\Guzzle\GuzzleExtension as Web;
use App\Lib\Vendor\Goutte\GoutteExtension as Spider;
use Symfony\Component\DomCrawler\Crawler as CoreCrawler;
use App\Lib\Vendor\Symfony\DomCrawler\CrawlerExtension as Crawler;
use App\Exceptions\Adapters\Aliexpress\AliexpressItemsAdapterException as Exception;


/**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 * - visit each category in Ali
 * - grab products by newest with orders count 
 * - store the 'category-newest' dataset
 * - run the process every 4 hours to compare changes per item
 * - products with X orders increased will be stored as 'Prospects' for forther treatment  
 */


 /**
  * Aliexpress Items Adapter
  */
 class AliexpressItemsAdapter extends BaseAliexpressAdapter 
 {

    /**
     * Channel item id holder
     * 
     * @var int
     */
    protected $channel_item_id = 0;


	/**
	 * Fetch targets
	 * 
     * @param StorageCategory $storageCategory
     * @return mixed
	 */        
    public function fetch($storageCategory=null) 
    {
        if(!($storageCategory instanceof StorageCategory)) throw new Exception(Exception::INVALID_STORAGE_CATEORY_INSTANCE);

        // prep target url
        $this->setPath($storageCategory->path)->setUrl();

        // prep clients
        $spider = new Spider();
        $web    = new web(['timeout' => 60]);
        $spider->setClient($web);
        $crawler = $spider->request('GET', $this->url);  
        
        // get items
        $crawler->filter('body ul#list-items li.list-item')->each(function (CoreCrawler $subcrawler) 
        {
            $this->channel_item_id = 0;  // ensure reset to avoid data assginement for wrong rcord

            // get channel_item_id
            $subcrawler->filter('input.atc-product-id')->each(function($node) 
            {
                $this->channel_item_id = intval(trim($node->attr('value')));
            });  

            if($this->channel_item_id) 
            {
                $fetch = [];

                // get title, path
                $subcrawler->filter('h3 a.product')->each(function($node) 
                {
                    $fetch['title'] = $node->attr('title');
                    $item_url       = $node->attr('href');                                
                    $fetch['path']  = $this->parseUrl($item_url);         
                });  

                // get img_src
                $subcrawler->filter('div.img img.picCore')->each(function($node) 
                {
                    $fetch['img_src'] = $node->attr('src');                               
                });
                
                // get price 
                $subcrawler->filter('span[itemprop="price"]')->each(function($node)
                {
                    $prices = $this->parsePrice($node->text());                               
                    $fetch['price_min'] = $prices['min'];
                    $fetch['price_max'] = $prices['max'];
                });  
                
                // get orders
                $subcrawler->filter('a.order-num-a')->each(function($node) 
                {
                    $fetch['orders'] = $this->parseOrders($node->text());                               
                });                  

                $this->fetch[$this->channel_item_id] = $fetch;
            }
        }); 
            
        // log results 
        Log::channel(Log::ADAPTERS_ITEMS)->info($this->domain . ' - returned ' . (!empty($this->fetch) ? 'full fetch :)' : 'empty fetch :/'), ['in' => __METHOD__ .':'.__LINE__]);
            
        return $this->fetch;        
    }


    /**
     * Check if proper url returned and extract the path 
     * 
     * Sample returned raw item urls :
     *  //www.aliexpress.com/item/2M-LED-Garland-Copper-Wire-Corker-String-Fairy-Lights-for-Glass-Craft-Bottle-New-Year-Christmas/32884789078.html?ws_ab_test=searchweb0_0,searchweb201602_4_10065_10068_318_10546_10059_10884_10548_10887_10696_100031_10084_10083_10103_452_10618_10307_532,searchweb201603_60,ppcSwitch_0&algo_expid=fc703309-0f99-4346-be65-61bc3757112f-0&algo_pvid=fc703309-0f99-4346-be65-61bc3757112f&transAbTest=ae803_5&priceBeautifyAB=0
     * 
     * @param string $url // item url in the channel
     * @return string // url path
     */
    private function parseUrl($url) 
    {
        // parse
        $path   = str_replace($this->domain, '', strstr($url, $this->domain));
        $path   = explode('?' , $path)[0]; // remove the query string
        $parts  = explode('/', $path);

        // catch vars
        $prefix         = $parts[1] ?? null;
        $slug           = $parts[2] ?? null;
        $item_html_file = $parts[3] ?? null;
        $item_id        = explode('.', $item_html_file)[0];

        // proper check
        if(!$prefix == 'item')      throw new Exception(Exception::INVALID_ITEM_URL         . ' | ' . print_r(['url' => $url], 1));
        if(!$slug)                  throw new Exception(Exception::INVALID_ITEM_URL_SLUG    . ' | ' . print_r(['url' => $url], 1));
        if(!is_numeric($item_id))   throw new Exception(Exception::INVALID_ITEM_URL_ID      . ' | ' . print_r(['url' => $url], 1));

        // build back path
        $path = implode('/' , $parts);

        return $path;
    }



    /**
     * Parse text prices to min & max prices
     * 
     * Sample returned raw prices str :
     * "US $0.18 - 0.89"
     * 
     * @param string $price
     * @return array 
     */
    private function parsePrice($prices) 
    {
		$parts = explode('-', $prices);

		if(count($parts) > 2) throw new Exception(Exception::FETCHED_INVALID_PRICES_STR . ' | prices str: ' . var_export($prices, 1));

		$min = (isset($parts[0]) ? (float) filter_var($parts[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : false);
		$max = (isset($parts[1]) ? (float) filter_var($parts[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : false);

		return ['min' => $min, 'max' => $max]; 
    }


    /**
     * TODO: ... 
     * 
     * Parse orders price text to int value
     * 
     * Sample returned raw price str :
     * "Orders (1805)"
     * 
     * @param string $orders
     * @return int 
     */
    private function parseOrders($orders) 
    {
        // extract numbers from string
        // $matches = filter_var($s, FILTER_SANITIZE_NUMBER_INT); // option - extracted digits, plus and minus sign 
        
        preg_match_all('!\d+!', $orders, $matches);  // option - extracted only digits

        return trim(intval($matches));
    }
 }
 
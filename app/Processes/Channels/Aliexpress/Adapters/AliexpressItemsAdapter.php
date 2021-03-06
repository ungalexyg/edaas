<?php 

namespace App\Processes\Channels\Aliexpress\Adapters;


use Log;
use App\Models\Collectors\Aliexpress\CAliexpressCategory;
use Symfony\Component\DomCrawler\Crawler as CoreCrawler;
use App\Lib\Vendor\Symfony\DomCrawler\CrawlerExtension as Crawler;
use App\Processes\Channels\Aliexpress\Exceptions\AliexpressItemsAdapterException as Exception;


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
    protected $item_id = 0;


	/**
	 * Fetch targets
	 * 
     * @param CAliexpressCategory $category
     * @return mixed
	 */        
    public function fetch($category=null) 
    {
        // prep target url
        $this->setPath($category->path)->setUrl();

        // prep clients
        $crawler = $this->spider->request('GET', $this->url);  
        
        // get items
        $crawler->filter('body #list-items li.list-item')->each(function (CoreCrawler $subcrawler) 
        {
            $this->item_id = 0;  // ensure reset to avoid data assginement for wrong rcord
            
            
            // get item_id
            $subcrawler->filter('input.atc-product-id')->each(function($node) 
            {
                $this->item_id = intval(trim($node->attr('value')));
            });  

            if($this->item_id) 
            {
                $this->bag[$this->item_id]['item_id'] = $this->item_id;

                // get title, path
                $subcrawler->filter('h3 a.product')->each(function($node) 
                {
                    $this->bag[$this->item_id]['title'] = $node->attr('title');
                    $item_url       = $node->attr('href');                                
                    $this->bag[$this->item_id]['path']  = $this->parseUrl($item_url);         
                });  

                // get img_src
                $subcrawler->filter('div.img img.picCore')->each(function($node) 
                {
                    $this->bag[$this->item_id]['img_src'] = $node->attr('src');                               
                });
                
                // get price 
                $subcrawler->filter('span[itemprop="price"]')->each(function($node)
                {
                    $prices = $this->parsePrice($node->text());                               
                    $this->bag[$this->item_id]['price_min'] = $prices['min'];
                    $this->bag[$this->item_id]['price_max'] = $prices['max'];
                });  
                
                // get orders
                $subcrawler->filter('a.order-num-a')->each(function($node) 
                {
                    $this->bag[$this->item_id]['orders'] = $this->parseOrders($node->text());                               
                });                  
            }
        }); 
            
        // log results 
        Log::channel(Log::ALIEXPRESS_ITEMS)->info($this->domain . ' - returned ' . (!empty($this->bag) ? 'full fetch :)' : 'empty fetch :/'), ['in' => __METHOD__ .':'.__LINE__]);  
        
        return $this->bag;        
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
     * Parse prices
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
     * Parse orders 
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
        $matches = filter_var($orders, FILTER_SANITIZE_NUMBER_INT); // option - extracted digits, plus and minus sign 
        
        //preg_match_all('!\d+!', $orders, $matches);  // option - extracted only digits

        return intval(trim($matches));
    }
 }
 
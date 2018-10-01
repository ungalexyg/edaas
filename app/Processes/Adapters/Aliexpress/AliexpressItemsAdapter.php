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

        $this->setPath($storageCategory->path)->setUrl();

        $spider = new Spider();
     
        $web = new web(['timeout' => 60]);
     
        $spider->setClient($web);

        $crawler = $spider->request('GET', $this->url);  
        
        
        # item basic data
        // title
        // path
        // path
        // price
        // orders
        // img_src

        # item system data
        // storage_category_id
        // channel_item_id

        # helpers
        //$url = $node->attr('href'); 
        // $node->text()        


        // get items
        $crawler->filter('body ul#list-items li.list-item')->each(function (CoreCrawler $subcrawler) 
        {
            $this->channel_item_id = 0;  // ensure reset to avoid data assginement for wrong rcord

            // get product channel id
            $subcrawler->filter('input.atc-product-id')->each(function($node) use($subcrawler) 
            {
                $this->channel_item_id = intval(trim($node->attr('value')));

                
                            
            });  

            if($this->channel_item_id) 
            {
                // get title
                $subcrawler->filter('h3 a.product')->each(function($node) use($subcrawler) 
                {
                    $this->fetch[$this->channel_item_id]['title'] = $node->attr('title');
                    $url = $node->attr('href');                                
                    $this->fetch[$this->channel_item_id]['path'] = $this->parseUrl($url);        
                    
                });  


                // $this->fetch['pro'] = 
                // $url = $node->attr('href');                                
                // $this->fetch['path'] = $this->parseUrl($url);    

                // // get img_src
                // $subcrawler->filter('div.img img.picCore')->each(function($node) use($subcrawler) 
                // {
                //     $this->fetch['img_src'] = $node->attr('src');                               
                // });                
            }
        }); 
                
        Log::channel(Log::ADAPTERS_ITEMS)->info($this->domain . ' - returned ' . (!empty($this->fetch) ? 'full fetch :)' : 'empty fetch :/'), ['in' => __METHOD__ .':'.__LINE__]);
            
        dd($this->fetch);

        return $this->fetch;        
    }


    /**
     * Convert item URL item path
     * 
     * TODO: ...
     * 
     * @param string $url
     * @return array // url parts
     */
    private function parseUrl($url) 
    {

        return $url;

        // // parse
        // $path   = str_replace($this->domain, '', strstr($url, $this->domain));
        // $path   = explode('?' , $path)[0]; // remove the query string
        // $parts  = explode('/', $path);

        // // catch vars
        // $prefix         = $parts[1] ?? null;
        // $category_id    = $parts[2] ?? null;

        // // proper check
        // if(!$prefix == 'category')      throw new Exception(Exception::INVALID_CATEGORY_URL . ' | ' . print_r(['url' => $url], 1));
        // if(!is_numeric($category_id))   throw new Exception(Exception::INVALID_CATEGORY_URL_ID . ' | ' . print_r(['url' => $url], 1));
        // if(!$path)                      throw new Exception(Exception::INVALID_CATEGORY_URL_PATH . ' | ' . print_r(['url' => $url], 1));

        // // return
        // return [
        //     'path' => $path,
        //     'channel_category_id' => intval($category_id),
        // ];
    }
 }
 
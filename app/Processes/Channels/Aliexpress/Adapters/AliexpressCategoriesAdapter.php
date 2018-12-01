<?php 

namespace App\Processes\Channels\Aliexpress\Adapters;

use Log;
use App\Lib\Vendor\Guzzle\GuzzleExtension as Web;
use App\Lib\Vendor\Goutte\GoutteExtension as Spider;
use Symfony\Component\DomCrawler\Crawler as CoreCrawler;
use App\Lib\Vendor\Symfony\DomCrawler\CrawlerExtension as Crawler;
use App\Processes\Channels\Aliexpress\Exceptions\AliexpressCategoriesAdapterException as Exception;


/**
 * Aliexpress Categories Adapter 
 * 
 * Handle Aliexpress categories operations
 * 
 * All categories page :
 * https://www.aliexpress.com/all-wholesale-products.html
 */
 class AliexpressCategoriesAdapter extends BaseAliexpressAdapter 
 {
    /**
     * Categories URL path
     * 
     * All categories URL:
     * https://www.aliexpress.com/all-wholesale-products.html
     * 
     * @var string 
     */
    protected $path = '/all-wholesale-products.html';


	/**
	 * Fetch destenation
	 * 
     * //TODO: single point of $this->bag build for all adapters
     * 
     * @param mixed $reference
     * @return array
	 */        
    public function fetch($reference=null) 
    {
        $this->setUrl();

        $spider = new Spider();
     
        $web = new web(['timeout' => 60]);
     
        $spider->setClient($web);

        $crawler = $spider->request('GET', $this->url);    

        $crawler->filter('body .cg-main .item.util-clearfix')->each(function (CoreCrawler $subcrawler) {

            $subcrawler->filter('h3.big-title > a')->each(function($node) use($subcrawler) {

                $url = $node->attr('href'); 

                $parsed = $this->parseUrl($url);
                
                $parent_category_id = $parsed['category_id'];

                $this->bag[] = [
                    'title'                         => $node->text(),
                    'path'                          => $parsed['path'],
                    'category_id'                   => $parent_category_id,
                    'parent_category_id'            => 0,
                ];

                $subcrawler->filter('ul.sub-item-cont > li > a')->each(function($node) use($parent_category_id) {

                    $url = $node->attr('href'); 

                    $parsed = $this->parseUrl($url);
                    
                    $category_id = $parsed['category_id'];

                    $this->bag[] = [
                        'title'                         => $node->text(),
                        'path'                          => $parsed['path'],
                        'category_id'                   => $category_id,
                        'parent_category_id'            => $parent_category_id,
                    ];
                });  
            });
        }); 
                
        Log::channel(Log::ALIEXPRESS_CATEGORIES)->info($this->domain . ' - fetched ' . (!empty($this->bag) ? 'full bag :)' : 'empty fetch :/'), ['in' => __METHOD__ .':'.__LINE__]);
            
        return $this->bag;
    }


    /**
     * Convert category URL to category ID
     * 
     * Sample returned raw category urls :
     * //www.aliexpress.com/category/18/sports-entertainment.html?g=y
     * //www.aliexpress.com/category/34/automobiles-motorcycles.html?g=y 
     * 
     * @param string $url
     * @return array // url parts
     */
    private function parseUrl($url) 
    {
        // parse
        $path   = str_replace($this->domain, '', strstr($url, $this->domain));
        $path   = explode('?' , $path)[0]; // remove the query string
        $parts  = explode('/', $path);

        // catch vars
        $prefix         = $parts[1] ?? null;
        $category_id    = $parts[2] ?? null;

        // proper check
        if(!$prefix == 'category')      throw new Exception(Exception::INVALID_CATEGORY_URL . ' | ' . print_r(['url' => $url], 1));
        if(!is_numeric($category_id))   throw new Exception(Exception::INVALID_CATEGORY_URL_ID . ' | ' . print_r(['url' => $url], 1));
        if(!$path)                      throw new Exception(Exception::INVALID_CATEGORY_URL_PATH . ' | ' . print_r(['url' => $url], 1));

        // return
        return [
            'path' => $path,
            'category_id' => intval($category_id),
        ];
    }
 }

<?php 

/**
 * --------------------------------------------------------------------------
 *  Resources
 * --------------------------------------------------------------------------
 * 
 * All categories page :
 * https://www.aliexpress.com/all-wholesale-products.html
 * 
 */


/**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 * - visit each category in Ali
 * - grab products by newest with orders count 
 * - store the 'category-newest' dataset
 */

namespace App\Processes\Adapters\Aliexpress;

//use App\Lib\Vendor\Symfony\DomCrawler\CrawlerExtension as Crawler;
use Illuminate\Support\Facades\Log;
use App\Lib\Vendor\Guzzle\GuzzleExtension as Web;
use App\Lib\Vendor\Goutte\GoutteExtension as Spider;
use Symfony\Component\DomCrawler\Crawler as CoreCrawler;
use App\Lib\Vendor\Symfony\DomCrawler\CrawlerExtension as Crawler;
use App\Exceptions\Adapters\Aliexpress\AliexpressCategoriesAdapterException;



/**
 * Aliexpress Categories Adapter 
 * 
 * Handle Aliexpress categories operations
 */
 class AliexpressCategoriesAdapter extends BaseAliexpressAdapter 
 {
    /**
     * URL scheme
     * 
     * @var string
     */
    protected $scheme = 'https';


    /**
     * Categories URL path
     * 
     * All categories URL:
     * https://www.aliexpress.com/all-wholesale-products.html
     * 
     * @var string 
     */
    protected $path = '/all-wholesale-products.html';

    // Argument 1 passed to 
    // App\Processes\Adapters\Aliexpress\AliexpressCategoriesAdapter::App\Processes\Adapters\Aliexpress\{closure}() 
    // must be an instance of App\Lib\Vendor\Symfony\DomCrawler\CrawlerExtension, 
    // instance of 
    // Symfony\Component\DomCrawler\Crawler given, called in 
    // /Users/ungalexy/code/valet/edaas/vendor/symfony/dom-crawler/Crawler.php on line 368


	/**
	 * Fetch destenation
	 * 
     * //TODO: single point of $this->fetch build for all adapters
     * 
     * @return array
	 */        
    public function fetch() 
    {
        $spider = new Spider();
     
        $web = new web(['timeout' => 60]);
     
        $spider->setClient($web);

        $crawler = $spider->request('GET', $this->url);    

        $crawler->filter('body .cg-main .item.util-clearfix')->each(function (CoreCrawler $subcrawler) {

            $subcrawler->filter('h3.big-title > a')->each(function($node) use($subcrawler) {

                $url = $node->attr('href'); 

                $parsed = $this->parseUrl($url);
                
                $parent_channel_category_id = $parsed['channel_category_id'];

                $this->fetch[] = [
                    'title'                         => $node->text(),
                    'path'                          => $parsed['path'],
                    'channel_category_id'           => $parent_channel_category_id,
                    'parent_channel_category_id'    => 0,
                ];

                $subcrawler->filter('ul.sub-item-cont > li > a')->each(function($node) use($parent_channel_category_id) {

                    $url = $node->attr('href'); 

                    $parsed = $this->parseUrl($url);
                    
                    $channel_category_id = $parsed['channel_category_id'];

                    $this->fetch[] = [
                        'title'                         => $node->text(),
                        'path'                          => $parsed['path'],
                        'channel_category_id'           => $channel_category_id,
                        'parent_channel_category_id'    => $parent_channel_category_id,
                    ];
                });  
            });
        }); 
                

        if(empty($this->fetch)) 
        {
            Log::channel('adapters')->info('returning empty fetch :/ ', ['location' => __METHOD__ .':'.__LINE__ , '$this->fetch' => $this->fetch]);
        }
        else 
        {
            Log::channel('adapters')->info('successful categories fetch!', ['location' => __METHOD__ .':'.__LINE__ ]);
        }
            
    
        return $this->fetch;
    }


    /**
     * Convert category URL to category ID
     * 
     * Sample returned category urls :
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
        if(!$prefix == 'category')      throw new AliexpressCategoriesAdapterException(AliexpressCategoriesAdapterException::INVALID_CATEGORY_URL . ' | ' . print_r(['url' => $url], 1));
        if(!is_numeric($category_id))   throw new AliexpressCategoriesAdapterException(AliexpressCategoriesAdapterException::INVALID_CATEGORY_URL_ID . ' | ' . print_r(['url' => $url], 1));
        if(!$path)                      throw new AliexpressCategoriesAdapterException(AliexpressCategoriesAdapterException::INVALID_CATEGORY_URL_PATH . ' | ' . print_r(['url' => $url], 1));

        // return
        return [
            'path' => $path,
            'channel_category_id' => intval($category_id),
        ];
    }
 }





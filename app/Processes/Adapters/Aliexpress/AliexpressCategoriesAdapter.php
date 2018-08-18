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
use App\Lib\Vendor\Guzzle\GuzzleExtension as Web;
use App\Lib\Vendor\Goutte\GoutteExtension as Spider;
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


	/**
	 * Fetch destenation
	 * 
     * @return array
	 */        
    public function fetch() 
    {
        $spider = new Spider();
     
        $web = new web(['timeout' => 60]);
     
        $spider->setClient($web);

        $crawler = $spider->request('GET', $this->url);    

        $crawler->filter('h3.big-title.anchor1 > a')->each(function ($node) {

            $url = $node->attr('href');

            $parsed = $this->parseUrl($url);

            $this->fetch[] = [
                'title'         => $node->text(),
                'category_id'   => $parsed['category_id'],
                'path'          => $parsed['path'],
            ];

        }); 
        
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
        $path           = $parts[3] ?? null;

        // proper check
        if(!$prefix == 'category')      throw new AliexpressCategoriesAdapterException(AliexpressCategoriesAdapterException::INVALID_CATEGORY_URL . ' | ' . print_r(['url' => $url], 1));
        if(!is_numeric($category_id))   throw new AliexpressCategoriesAdapterException(AliexpressCategoriesAdapterException::INVALID_CATEGORY_URL_ID . ' | ' . print_r(['url' => $url], 1));
        if(!$path)                      throw new AliexpressCategoriesAdapterException(AliexpressCategoriesAdapterException::INVALID_CATEGORY_URL_PATH . ' | ' . print_r(['url' => $url], 1));

        // return
        return [
            'category_id' => intval($category_id),
            'path' => '/' . $path,
        ];
    }

 }





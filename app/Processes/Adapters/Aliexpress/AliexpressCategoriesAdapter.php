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
use App\Lib\Vendor\Goutte\GoutteExtension as Spider;
use App\Lib\Vendor\Guzzle\GuzzleExtension as Web;



/**
 * Aliexpress Categories Adapter 
 * 
 * Handle Aliexpress categories operations
 */
 class AliexpressCategoriesAdapter extends BaseAliexpressAdapter {

    /**
     * URL scheme
     * 
     * @var string
     */
    protected $scheme = 'https';


    /**
     * URL path
     * 
     * @var string 
     */
    protected $path = 'all-wholesale-products.html';


	/**
	 * Fetch targets
	 * 
     * TODO: store the grabed the links ....
     * 
     * @return mixed
	 */        
    public function fetch() 
    {
        $spider = new Spider();
     
        $web = new web(['timeout' => 60]);
     
        $spider->setClient($web);

        $crawler = $spider->request('GET', $this->url);    

        $crawler->filter('h3.big-title.anchor1 > a')->each(function ($node) {
            print $node->text()."\n";
        });        
    }

 }





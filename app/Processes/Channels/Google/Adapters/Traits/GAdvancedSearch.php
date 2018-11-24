<?php

namespace App\Processes\Adapters\Google\Traits;

//use App\Lib\Vendor\Symfony\DomCrawler\CrawlerExtension as Crawler;
//use App\Lib\Vendor\Goutte\GoutteExtension as Spider;
use App\Lib\Vendor\Guzzle\GuzzleExtension as Web;




/**
 * --------------------------------------------------------------------------
 *  Resources
 * --------------------------------------------------------------------------
 * 
 *  # Google advanced search docs
 * 
 * googleguide.com/advanced_operators_reference.html
 * 
 *  # Google General Support
 * 
 * support.google.com/websearch/#topic=3378866 
 * 
 *  # Google segmented searches:
 * 
 * google.com/shopping
 * google.com/elections
 * google.com/finance
 * google.com/movies
 * google.com/flights
 * 
 * 	# Google advanced searhces tools
 * 
 * google.com/advanced_search 
 * google.com/advanced_book_search
 * google.com/advanced_image_search
 * news.google.com/news/advanced_news_search
 * google.com/advanced_patent_search
 * google.com/advanced_video_search
 * google.com/advanced_search?tbm=blg
 * 
 * 	# API based on generated searches in 
 * 
 * google.com/advanced_search
 * 
 * 	sample query, get the best selling products in shopify stores from the last 24 hours
 * 
 *   google.com/search?as_qdr=d&as_sitesearch=myshopify.com/collections/all 
 * 
 */

 
/**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 * 
 * TODO: check how to make the CSE private
 * 
 * 
 * 
 */



/**
 * Google Advanced Search (GAS)
 * 
 * https://www.google.com/advanced_search
 */
trait GAdvancedSearch 
{
	/**
	 * Searcdh endpoiint
	 */
	protected $gas_endpoint = 'https://www.google.com/search';		


	/**
	 * Perform Search 
	 * 
	 * @param $query // the search text
	 * @return mixed
	 */
	public function GASearch($query)
	{
		$qs = http_build_query([
			'as_q' 			=> '',
			'as_epq'		=> '',
			'as_oq'			=> '',
			'as_eq'			=> '',
			'as_nlo'		=> '',
			'as_nhi'		=> '',
			'lr'			=> '',			
			'cr'			=> '',			
			'as_qdr'		=> 'd',	 // datetime, d = in last day 24h
			'as_sitesearch' => 'myshopify.com/collections/all',
			'as_occt'		=> 'any',
			'safe' 			=> 'images',
			'as_filetype'	=> '',
			'as_rights'		=> '',
		]);

		$url = $this->gcse_endpoint . '?' .$qs;

		return app(Web::class)->get($url);
	}

}
<?php

namespace App\Processes\Adapters\Google\Traits;

//use App\Lib\Vendor\Symfony\DomCrawler\CrawlerExtension as Crawler;
//use App\Lib\Vendor\Goutte\GoutteExtension as Spider;
use App\Lib\Vendor\Guzzle\GuzzleExtension as Web;



/**
 * --------------------------------------------------------------------------
 *  Resources
 * --------------------------------------------------------------------------
 * Google shopping insights
 * https://shopping.thinkwithgoogle.com/
 * 
 */


/**
 * --------------------------------------------------------------------------
 *  API
 * --------------------------------------------------------------------------
 * G-CSE Console
 * https://cse.google.com/cse/all
 * 
 * Google Custom Search API docs
 * https://developers.google.com/custom-search/json-api/v1/overview
 * 
 * API query params 
 * https://developers.google.com/custom-search/json-api/v1/reference/cse/list 
 * 
 * 
 * Limitations
 * JSON Custom Search API provides 100 search queries per day for free. If you need more, you may sign up for billing in the API Console. Additional requests cost $5 per 1000 queries, up to 10k queries per day. 
 * 
 * Sample query - CSE 
 * https://www.googleapis.com/customsearch/v1?q={searchTerms}&num={count?}&start={startIndex?}&lr={language?}&safe={safe?}&cx={cx?}&cref={cref?}&sort={sort?}&filter={filter?}&gl={gl?}&cr={cr?}&googlehost={googleHost?}&c2coff={disableCnTwTranslation?}&hq={hq?}&hl={hl?}&siteSearch={siteSearch?}&siteSearchFilter={siteSearchFilter?}&exactTerms={exactTerms?}&excludeTerms={excludeTerms?}&linkSite={linkSite?}&orTerms={orTerms?}&relatedSite={relatedSite?}&dateRestrict={dateRestrict?}&lowRange={lowRange?}&highRange={highRange?}&searchType={searchType}&fileType={fileType?}&rights={rights?}&imgSize={imgSize?}&imgType={imgType?}&imgColorType={imgColorType?}&imgDominantColor={imgDominantColor?}&alt=json
 * 
 * Sample query - search images by key in site 
 * https://www.google.co.uk/search?q=site:virgin.com+cable&tbm=isch 
 * 
 * Sample query - reverse search by images
 * http://images.google.com/searchbyimage?image_url=<your image url here>
 * 
 */


 
/**
 * --------------------------------------------------------------------------
 *  TODO:
 * --------------------------------------------------------------------------
 * 
 * TODO: check how to make the CSE private
 * 
 */



/**
 * Google Custom Search Engine
 * 
 * (properties prefix : gcse)
 */
trait GCustomSearch 
{
	/**
	 * GCSE API key
	 */		
	protected $gcse_api_key = 'AIzaSyDsEebc8QomUfAoXhcMLZNTtBPVISPRlgU'; 

	
	/**
	 * GCSE private CX key unique per pre configed custom search
	 */	
	protected $gcse_cx = '018124074902099226352:xk_fnj8ra5k';

	
	/**
	 * GCSE endpoint
	 */	
	protected $gcse_endpoint = 'https://www.googleapis.com/customsearch/v1';


	/**
	 * Revenrse image search endpoint
	 */
	protected $gcse_google_endpoint = 'https://www.google.com/search';		


	/**
	 * Perform Google Custom Search 
	 * 
	 * @param $query // the search text
	 * @return mixed
	 */
	public function gcseSearch($query)
	{
		$qs = http_build_query([
			'key' 			=> $this->gcse_api_key,
			'cx' 			=> $this->gcse_cx,
			'q' 			=> $query,
			'exactTerms' 	=> $query, // Identifies a phrase that all documents in the search results must contain
			'dateRestrict' 	=> 'd[1]', // requests results from the specified number of past dayes/weeks/years. d[] | m[] | y[] 
			'start' 		=> 1, // generic: res['queries']['nextPage'][0]['startIndex'] , default is 1			
			'num'			=> 10, // Valid values are integers between 1 and 10, inclusive.
			//'searchType'	=> 'image' // [NOT WORING] Specifies the search type: image.  If unspecified, results are limited to webpages. 
		]);

		$url = $this->gcse_endpoint . '?' .$qs;

		return app(Web::class)->get($url);
	}

}
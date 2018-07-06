<?php

namespace App\Processes\Adapters\Traits;

use GuzzleHttp\Client as Guzzle;
use Goutte\Client as Goutte;


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
 * 
 * DONE: heck how to reverse search by image
 * - http://images.google.com/searchbyimage?image_url=<your image url here>
 */





/**
 * Google Custom Search Engine
 */
trait GCSE {

	
	/**
	 * GCSE API key
	 */		
	protected $api_key = 'AIzaSyDsEebc8QomUfAoXhcMLZNTtBPVISPRlgU'; 

	
	/**
	 * GCSE private CX key unique per pre configed custom search
	 */	
	protected $cx = '018124074902099226352:xk_fnj8ra5k';

	
	/**
	 * GCSE endpoint
	 */	
	protected $cse_endpoint = 'https://www.googleapis.com/customsearch/v1';


	/**
	 * Revenrse image search endpoint
	 */
	protected $cse_img_endpoint = 'http://images.google.com/searchbyimage?image_url=';	
	

	/**
	 * Search
	 * 
	 * @param $query
	 * @return mixed
	 */
	public function gcseSearch($query)
	{
		$qs = http_build_query([
			'key' 			=> $this->api_key,
			'cx' 			=> $this->cx,
			'q' 			=> $query,
			'exactTerms' 	=> $query, // Identifies a phrase that all documents in the search results must contain
			'dateRestrict' 	=> 'd[1]', // requests results from the specified number of past dayes/weeks/years. d[] | m[] | y[] 
			'start' 		=> 1, // generic: res['queries']['nextPage'][0]['startIndex'] , default is 1			
			'num'			=> 10, // Valid values are integers between 1 and 10, inclusive.
			//'searchType'	=> 'image' // [NOT WORING] Specifies the search type: image.  If unspecified, results are limited to webpages. 
		]);

		$url = $this->cse_endpoint . '?' .$qs;

		//dd($url);

		//$url = 'https://www.google.co.il/search?q=site%3Amyshopify.com%2Fcollections%2Fsunglasses&oq=site%3Amyshopify.com%2Fcollections%2Fsunglasses&aqs=chrome..69i57j69i58j69i59.700j0j9&sourceid=chrome&ie=UTF-8';		

		$res = app(Guzzle::class)->get($url);

		//echo '<pre>';	
		//echo $res->getStatusCode(); // 200
		//echo $res->getHeaderLine('content-type'); 
		echo $res->getBody(); 

		//die;	
	}



	/**
	 * Search by image (reverse search)
	 * 
	 * @param $img_url
	 * @return mixed
	 */
	public function gcseImageSearch($img_url)
	{
		$url = $this->cse_img_endpoint . $img_url;

		/*  ------------------------------------------------------ 
		# Working option only with Guzzle

		$res = app(Guzzle::class)->get($url, [
			'allow_redirects' => false  // required to catch middle redirect
		]);

		//echo $res->getStatusCode(); 
		//echo $res->getHeaderLine('content-type'); 
		//echo $res->getRedirectCount();
		echo $res->getBody();	 		

		/* ------------------------------------------------------ */




		/*  ------------------------------------------------------
		# Sample interaction Guzzle + Goutte 
		


		$goutte = new Goutte();		
		$guzzle = new Guzzle([
			'timeout' => 60,
			'allow_redirects' => false
		]);
		$goutte->setClient($guzzle);

		$crawler = $goutte->request('GET', $url);

		$crawler->filter('a')->each(function ($node) {
			echo  $node->text()."\n";
		});
	
		/* ------------------------------------------------------ */
		

	}	


}
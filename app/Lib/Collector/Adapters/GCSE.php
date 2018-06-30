<?php
namespace App\Lib\Collector\Adapters;
use GuzzleHttp\Client as HttpClient;

/**
 * --------------------------------------------------------------------------
 *  API
 * --------------------------------------------------------------------------
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
 * Sample query
 * https://www.googleapis.com/customsearch/v1?q={searchTerms}&num={count?}&start={startIndex?}&lr={language?}&safe={safe?}&cx={cx?}&cref={cref?}&sort={sort?}&filter={filter?}&gl={gl?}&cr={cr?}&googlehost={googleHost?}&c2coff={disableCnTwTranslation?}&hq={hq?}&hl={hl?}&siteSearch={siteSearch?}&siteSearchFilter={siteSearchFilter?}&exactTerms={exactTerms?}&excludeTerms={excludeTerms?}&linkSite={linkSite?}&orTerms={orTerms?}&relatedSite={relatedSite?}&dateRestrict={dateRestrict?}&lowRange={lowRange?}&highRange={highRange?}&searchType={searchType}&fileType={fileType?}&rights={rights?}&imgSize={imgSize?}&imgType={imgType?}&imgColorType={imgColorType?}&imgDominantColor={imgDominantColor?}&alt=json
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
 */
class GCSE {


	private $api_key = 'AIzaSyDsEebc8QomUfAoXhcMLZNTtBPVISPRlgU'; // JSON Custom Search API 

	private $endpoint = 'https://www.googleapis.com/customsearch/v1';

	private $cx = '018124074902099226352:xk_fnj8ra5k';
	

	/**
	 * Search
	 */
	public function search($query)
	{
		$qs = http_build_query([
			'key' 			=> $this->api_key,
			'q' 			=> $query,
			'cx' 			=> $this->cx,
			'exactTerms' 	=> $query, // Identifies a phrase that all documents in the search results must contain
			'dateRestrict' 	=> 'd[1]', // requests results from the specified number of past dayes/weeks/years. d[] | m[] | y[] 
			'start' 		=> 1, // generic: res['queries']['nextPage'][0]['startIndex'] , default is 1			
			'num'			=> 10, // Valid values are integers between 1 and 10, inclusive.
		]);

		$url = $this->endpoint . '?' .$qs;

		//dd($url);

		//$url = 'https://www.google.co.il/search?q=site%3Amyshopify.com%2Fcollections%2Fsunglasses&oq=site%3Amyshopify.com%2Fcollections%2Fsunglasses&aqs=chrome..69i57j69i58j69i59.700j0j9&sourceid=chrome&ie=UTF-8';		

		$res = app(HttpClient::class)->get($url);

		//echo '<pre>';	
		//echo $res->getStatusCode(); // 200
		//echo $res->getHeaderLine('content-type'); 
		echo $res->getBody(); 

		//die;	
	}




}
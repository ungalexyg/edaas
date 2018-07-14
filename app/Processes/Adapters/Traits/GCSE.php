<?php

namespace App\Processes\Adapters\Traits;

// use GuzzleHttp\Client as Guzzle;
// use Goutte\Client as Goutte;

use App\Lib\Vendor\Goutte\GoutteExtension as Goutte;
use App\Lib\Vendor\Guzzle\GuzzleExtension as Guzzle;



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



 /*

images redirects

 Array
(
    [O:36:"Symfony\Component\BrowserKit\Request":7:{s:6:"*uri";s:193:"http://images.google.com/searchbyimage?image_url=https://ae01.alicdn.com/kf/HTB1RrfMjCYTBKNjSZKbq6xJ8pXai/T-Shirt-Women-Summer-Short-Sleeve-V-Neck-t-shirt-Female-Cactus-Funny-Letter-Print-T.jpg";s:9:"*method";s:3:"GET";s:13:"*parameters";a:0:{}s:8:"*files";a:0:{}s:10:"*cookies";a:0:{}s:9:"*server";a:3:{s:15:"HTTP_USER_AGENT";s:18:"Symfony BrowserKit";s:9:"HTTP_HOST";s:17:"images.google.com";s:5:"HTTPS";b:0;}s:10:"*content";N;}] => 1
    [O:36:"Symfony\Component\BrowserKit\Request":7:{s:6:"*uri";s:375:"http://images.google.com/search?tbs=sbi:AMhZZivsxjxD_1cMMugnlSrn-28PBhd6nOo0ALBSr1N4ezB-kHf709_1H0NacZqDszY0Iy03oKoLE8QbovLZgBmZ4NSdY-pi9UsTSYyCjC3tKDIwhsfxdmelDYyoJUcLxql5BxQTqr0er488z61xFukqPFLT8ABS6SOUc-ZjMgLN-fFlxrEh1i5SWD7TvwwS1KajP4O7Vi10w-Ft2ZU8pAbHANMHUeKSEznBrKusA46jeau2koJ-6WpxwEsz2eBAr_1F4xGQVq4lB50kaxC7mj3yD3jFvnzvzIf8a5KVx6ZoaEyZQo0529QdLizg89FNyxOf2TFmgXDtFd4";s:9:"*method";s:3:"GET";s:13:"*parameters";a:0:{}s:8:"*files";a:0:{}s:10:"*cookies";a:0:{}s:9:"*server";a:4:{s:15:"HTTP_USER_AGENT";s:18:"Symfony BrowserKit";s:9:"HTTP_HOST";s:17:"images.google.com";s:5:"HTTPS";b:0;s:12:"HTTP_REFERER";s:193:"http://images.google.com/searchbyimage?image_url=https://ae01.alicdn.com/kf/HTB1RrfMjCYTBKNjSZKbq6xJ8pXai/T-Shirt-Women-Summer-Short-Sleeve-V-Neck-t-shirt-Female-Cactus-Funny-Letter-Print-T.jpg";}s:10:"*content";N;}] => 1
    [O:36:"Symfony\Component\BrowserKit\Request":7:{s:6:"*uri";s:374:"http://images.google.com/webhp?tbs=sbi:AMhZZivsxjxD_1cMMugnlSrn-28PBhd6nOo0ALBSr1N4ezB-kHf709_1H0NacZqDszY0Iy03oKoLE8QbovLZgBmZ4NSdY-pi9UsTSYyCjC3tKDIwhsfxdmelDYyoJUcLxql5BxQTqr0er488z61xFukqPFLT8ABS6SOUc-ZjMgLN-fFlxrEh1i5SWD7TvwwS1KajP4O7Vi10w-Ft2ZU8pAbHANMHUeKSEznBrKusA46jeau2koJ-6WpxwEsz2eBAr_1F4xGQVq4lB50kaxC7mj3yD3jFvnzvzIf8a5KVx6ZoaEyZQo0529QdLizg89FNyxOf2TFmgXDtFd4";s:9:"*method";s:3:"GET";s:13:"*parameters";a:0:{}s:8:"*files";a:0:{}s:10:"*cookies";a:2:{s:6:"1P_JAR";s:13:"2018-07-07-13";s:3:"NID";s:132:"134=5OnE5EXJwQNh0VZR52_WkXwlv5jCIEc2eM5ptP-wppfEjmZ-i9Cuqyd5XeHEIDmyIqaDcJnb0ii52jc6fq6KhBzxBfbwedaI6VkuQukbkU0EKpFnnQPwHNIPXa3DfBTb";}s:9:"*server";a:4:{s:15:"HTTP_USER_AGENT";s:18:"Symfony BrowserKit";s:9:"HTTP_HOST";s:17:"images.google.com";s:5:"HTTPS";b:0;s:12:"HTTP_REFERER";s:375:"http://images.google.com/search?tbs=sbi:AMhZZivsxjxD_1cMMugnlSrn-28PBhd6nOo0ALBSr1N4ezB-kHf709_1H0NacZqDszY0Iy03oKoLE8QbovLZgBmZ4NSdY-pi9UsTSYyCjC3tKDIwhsfxdmelDYyoJUcLxql5BxQTqr0er488z61xFukqPFLT8ABS6SOUc-ZjMgLN-fFlxrEh1i5SWD7TvwwS1KajP4O7Vi10w-Ft2ZU8pAbHANMHUeKSEznBrKusA46jeau2koJ-6WpxwEsz2eBAr_1F4xGQVq4lB50kaxC7mj3yD3jFvnzvzIf8a5KVx6ZoaEyZQo0529QdLizg89FNyxOf2TFmgXDtFd4";}s:10:"*content";N;}] => 1
)
 
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

		$guzzle = new Guzzle([
			'allow_redirects' => false  // disable redirct to catch middle page with images url
		]);

		//$c = $guzzle->getConfig();
		$res = $guzzle->get($url);
		
		
		//echo $res->getStatusCode(); 
		//echo $res->getHeaderLine('content-type'); 
		//echo $res->getRedirectCount();
		echo $res->getBody();	 		

		/* ------------------------------------------------------ */




		/*  ------------------------------------------------------ */
		# Sample interaction Guzzle + Goutte 
		

	/*################################################*/

	// TODO:

	// // 1) clone 
	// 	Symfony\Component\BrowserKit\Client (clone only the clint class in that dir)		
	// 	to
	// 	App\Lib\Vendors\BrowserKit\Client (custom, for flexibilty)


	// // 2) clone 
	// 	Goutte\Client
	// 	to
	// 	App\Lib\Vendors\Goutte\Client (custom, for flexibilty)

	// * App\Lib\Vendors\ (for vendors extends)


	// 3) get the redirect property to catch google images redirects

	


		// the middle one is the currect url : 

		$goutte = new Goutte();		
		$guzzle = new Guzzle([
			'timeout' => 60,
			'allow_redirects' => false
		]);
		$goutte->setClient($guzzle);

		$crawler = $goutte->request('GET', $url);

		dd($goutte->getRedirects());	

		// $crawler->filter('a')->each(function ($node) {
		// 	echo  $node->text()."\n";
		// });


	// Array
	// (
	// 	[O:36:"Symfony\Component\BrowserKit\Request":7:{s:6:"*uri";s:193:"http://images.google.com/searchbyimage?image_url=https://ae01.alicdn.com/kf/HTB1RrfMjCYTBKNjSZKbq6xJ8pXai/T-Shirt-Women-Summer-Short-Sleeve-V-Neck-t-shirt-Female-Cactus-Funny-Letter-Print-T.jpg";s:9:"*method";s:3:"GET";s:13:"*parameters";a:0:{}s:8:"*files";a:0:{}s:10:"*cookies";a:0:{}s:9:"*server";a:3:{s:15:"HTTP_USER_AGENT";s:18:"Symfony BrowserKit";s:9:"HTTP_HOST";s:17:"images.google.com";s:5:"HTTPS";b:0;}s:10:"*content";N;}] => 1
	// 	[O:36:"Symfony\Component\BrowserKit\Request":7:{s:6:"*uri";s:375:"http://images.google.com/search?tbs=sbi:AMhZZivsxjxD_1cMMugnlSrn-28PBhd6nOo0ALBSr1N4ezB-kHf709_1H0NacZqDszY0Iy03oKoLE8QbovLZgBmZ4NSdY-pi9UsTSYyCjC3tKDIwhsfxdmelDYyoJUcLxql5BxQTqr0er488z61xFukqPFLT8ABS6SOUc-ZjMgLN-fFlxrEh1i5SWD7TvwwS1KajP4O7Vi10w-Ft2ZU8pAbHANMHUeKSEznBrKusA46jeau2koJ-6WpxwEsz2eBAr_1F4xGQVq4lB50kaxC7mj3yD3jFvnzvzIf8a5KVx6ZoaEyZQo0529QdLizg89FNyxOf2TFmgXDtFd4";s:9:"*method";s:3:"GET";s:13:"*parameters";a:0:{}s:8:"*files";a:0:{}s:10:"*cookies";a:0:{}s:9:"*server";a:4:{s:15:"HTTP_USER_AGENT";s:18:"Symfony BrowserKit";s:9:"HTTP_HOST";s:17:"images.google.com";s:5:"HTTPS";b:0;s:12:"HTTP_REFERER";s:193:"http://images.google.com/searchbyimage?image_url=https://ae01.alicdn.com/kf/HTB1RrfMjCYTBKNjSZKbq6xJ8pXai/T-Shirt-Women-Summer-Short-Sleeve-V-Neck-t-shirt-Female-Cactus-Funny-Letter-Print-T.jpg";}s:10:"*content";N;}] => 1
	// 	[O:36:"Symfony\Component\BrowserKit\Request":7:{s:6:"*uri";s:374:"http://images.google.com/webhp?tbs=sbi:AMhZZivsxjxD_1cMMugnlSrn-28PBhd6nOo0ALBSr1N4ezB-kHf709_1H0NacZqDszY0Iy03oKoLE8QbovLZgBmZ4NSdY-pi9UsTSYyCjC3tKDIwhsfxdmelDYyoJUcLxql5BxQTqr0er488z61xFukqPFLT8ABS6SOUc-ZjMgLN-fFlxrEh1i5SWD7TvwwS1KajP4O7Vi10w-Ft2ZU8pAbHANMHUeKSEznBrKusA46jeau2koJ-6WpxwEsz2eBAr_1F4xGQVq4lB50kaxC7mj3yD3jFvnzvzIf8a5KVx6ZoaEyZQo0529QdLizg89FNyxOf2TFmgXDtFd4";s:9:"*method";s:3:"GET";s:13:"*parameters";a:0:{}s:8:"*files";a:0:{}s:10:"*cookies";a:2:{s:6:"1P_JAR";s:13:"2018-07-07-13";s:3:"NID";s:132:"134=5OnE5EXJwQNh0VZR52_WkXwlv5jCIEc2eM5ptP-wppfEjmZ-i9Cuqyd5XeHEIDmyIqaDcJnb0ii52jc6fq6KhBzxBfbwedaI6VkuQukbkU0EKpFnnQPwHNIPXa3DfBTb";}s:9:"*server";a:4:{s:15:"HTTP_USER_AGENT";s:18:"Symfony BrowserKit";s:9:"HTTP_HOST";s:17:"images.google.com";s:5:"HTTPS";b:0;s:12:"HTTP_REFERER";s:375:"http://images.google.com/search?tbs=sbi:AMhZZivsxjxD_1cMMugnlSrn-28PBhd6nOo0ALBSr1N4ezB-kHf709_1H0NacZqDszY0Iy03oKoLE8QbovLZgBmZ4NSdY-pi9UsTSYyCjC3tKDIwhsfxdmelDYyoJUcLxql5BxQTqr0er488z61xFukqPFLT8ABS6SOUc-ZjMgLN-fFlxrEh1i5SWD7TvwwS1KajP4O7Vi10w-Ft2ZU8pAbHANMHUeKSEznBrKusA46jeau2koJ-6WpxwEsz2eBAr_1F4xGQVq4lB50kaxC7mj3yD3jFvnzvzIf8a5KVx6ZoaEyZQo0529QdLizg89FNyxOf2TFmgXDtFd4";}s:10:"*content";N;}] => 1
	// )

	################################################*/

		
	// $goutte = new Goutte();		
	// $guzzle = new Guzzle([
	// 	'timeout' => 60,
	// 	'allow_redirects' => false
	// ]);
	// $goutte->setClient($guzzle);

	// //$goutte->setClient($guzzle);		
	// $crawler = $goutte->request('GET', $url);
	// echo '<pre>';	
	// print_r($goutte->redirects);
	// die("\n END");
	
		/* ------------------------------------------------------ */
		

		
			/* ------------------------------------------------------ */
			# reflections options to access parent private prop

			# 1) reflection option 
			// $sweetsThief = \Closure::bind(function (Goutte $goutte) {
			// 	return $goutte->redirects;
			// }, null, 'Goutte\Client');
			// $v = $sweetsThief($goutte);


			# 2) reflection option 
			// $goutte = new Goutte();
			// $sweetsThief = new \ReflectionProperty('Goutte\Client', 'redirects');
			// $sweetsThief->setAccessible(true);		
			// $v = $sweetsThief->getValue($goutte);		
			/* ------------------------------------------------------ */
		



		
		

	}	


}
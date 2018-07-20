<?php

namespace App\Processes\Adapters\Traits;

// use GuzzleHttp\Client as Guzzle;
// use Goutte\Client as Goutte;

use App\Lib\Vendor\Goutte\GoutteExtension as Spider;
use App\Lib\Vendor\Guzzle\GuzzleExtension as Web;

use Symfony\Component\DomCrawler\Crawler;


/**
 * --------------------------------------------------------------------------
 *  Resources
 * --------------------------------------------------------------------------
 * Google shopping insights
 * https://shopping.thinkwithgoogle.com/
 * 
 * https://stackoverflow.com/questions/28391442/unable-to-scrape-google
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
 * TODO: check image search by site
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

	use GReverseImageHelpers, CrawlerHelpers;

	
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
	protected $cse_img_endpoint = 'http://images.google.com/searchbyimage';	
	

	/**
	 * Revenrse image search endpoint
	 */
	protected $cse_google_endpoint = 'https://www.google.com/search';		


	/**
	 * Search by image (reverse search)
	 *   
	 * 
	 * @param $img_url
	 * @return mixed
	 */
	public function gcseImageSearch($img_url)
	{


		/* working custom curl --------------------------------- */
		$pic_url = 'http://kaizern.com/blog/beautiful-landscapes-1.jpg';
		$dom = new GReverseImageCustom($pic_url);
		die;
		/* --------------------------------- */
		



		
		$web 						= new Web(['timeout' => 60, 'allow_redirects' => true]);
		$spider 					= new Spider();		
		$spider->setClient($web);




		#### round 1

		$url_search_img 			= $this->cse_img_endpoint . '?' . http_build_query(['image_url' => $img_url, 'gws_rd'=>'ssl']);

		$spider->followRedirects(true);
		$spider->setHeader('User-Agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36');		
		$crawler 					= $spider->request('GET', $url_search_img);

		//die($crawler->html());

		$nodeValues = $crawler->filter('body a')->each(function ($node, $i) {
			return ['href' => $node->attr('href'), 'text' => $node->text()];
		});		
		echo '<pre>';
		print_r($nodeValues);
		die;

		$catched_redirects 			= $spider->getRedirectsUris();
		
		$found_query 				= parse_url($catched_redirects[1], PHP_URL_QUERY);

		$generated_url_search_img_results 	= $this->cse_google_endpoint . '?' . $found_query;

		#### round 2

		$spider->request('GET', $generated_url_search_img_results);

		$this->redirects_uris = null; //reset the redirects

		$catched_redirects2 	 = $spider->getRedirectsUris(); //set & get again

		


		


		//echo $res->getBody(); die;

		### Current

		echo '<pre>';

		echo '<h1>Current</h1>';

		echo '<hr />$url_search_img : <br/><br/>';
		echo $url_search_img;

		echo '<hr />$catched_redirects 1: <br/><br/>';
		print_r($catched_redirects);
		
		echo '<hr />$catched_redirects 2: <br/><br/>';
		print_r($catched_redirects2);		

		echo '<hr />curr $found_query : <br/><br/>';
		echo $found_query;			


		echo '<hr />curr $generated_url_search_img_results : <br/><br/>';
		echo $generated_url_search_img_results;				

		
		### History

		echo '<h1>History</h1>';

		echo '<hr />$generated_search_img_results_urls : <br/><br/>';
		$generated_search_img_results_urls = [
			'https://www.google.com/search?tbs=sbi:AMhZZivMD3wnHikH-opZIU1xDeJxRUpjHf1_1HDIIEAxxsv5akuXQb0X43ew1B-KRiCM6CfGzaovYy-VPwsI75SujkEcAw0FxS9zBfdSXWz9rdPAFUbo7B21n335sCQfGVasJLhmLGJqqH6ByBeaKZGp8JJRo0iyD7_1FcqynWpkqGsaw6LwoIOp2ihcxiB1rq3tXOWkFFgbPG8EaGbHZ55jNfvrBQIXKN5GkTLdP2HcbwMcr97up2u2De23pTZMmBhhfjOO7kIjV7FUlhXYzyjYLAnQ5ioPpb6Skob7Gzcx64uHzltsnKrhq68Z7qPo_1n1hQ7v1RSpPvdX1i466Y4eL1k6HVax-I6vw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZivMD3wnHikH-opZIU1xDeJxRUpjHf1_1HDIIEAxxsv5akuXQb0X43ew1B-KRiCM6CfGzaovYy-VPwsI75SujkEcAw0FxS9zBfdSXWz9rdPAFUbo7B21n335sCQfGVasJLhmLGJqqH6ByBeaKZGp8JJRo0iyD7_1FcqynWpkqGsaw6LwoIOp2ihcxiB1rq3tXOWkFFgbPG8EaGbHZ55jNfvrBQIXKN5GkTLdP2HcbwMcr97up2u2De23pTZMmBhhfjOO7kIjV7FUlhXYzyjYLAnQ5ioPpb6Skob7Gzcx64uHzltsnKrhq68Z7qPo_1n1hQ7v1RSpPvdX1i466Y4eL1k6HVax-I6vw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZiuOUFavXP8VILg6KcvNOOfIPnIsUQdr--zFp1j3iMKfY8Utby0OFLvCbjweE85gWxIC-cUa7kc1lRebcHnzVUtp9Q22vXFEQ1HxOe6lgI-dAZaPdBcF4uXuuVFbdUFOeNP6Bwj_1I83lmquEOkETjq-GztsDk6ZgrpWM9_1brvrXgN7xM5_1PbobYK-RYP6afnA7fNWZEZw_1myB9y1Tmu9Cv5Ewe2o5WGvRhULISaB5EGweXWwHuhAge8qUxPkXDXvDCEuxQg4t0Bf70UVjtBRbREU9oGmw_1IAqQtfHYud6TGZviTmfkdRXW0gTSaWvktAOHvy09jkaHFFV9kTuwfwihuy9_1_1Xlw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZiuOUFavXP8VILg6KcvNOOfIPnIsUQdr--zFp1j3iMKfY8Utby0OFLvCbjweE85gWxIC-cUa7kc1lRebcHnzVUtp9Q22vXFEQ1HxOe6lgI-dAZaPdBcF4uXuuVFbdUFOeNP6Bwj_1I83lmquEOkETjq-GztsDk6ZgrpWM9_1brvrXgN7xM5_1PbobYK-RYP6afnA7fNWZEZw_1myB9y1Tmu9Cv5Ewe2o5WGvRhULISaB5EGweXWwHuhAge8qUxPkXDXvDCEuxQg4t0Bf70UVjtBRbREU9oGmw_1IAqQtfHYud6TGZviTmfkdRXW0gTSaWvktAOHvy09jkaHFFV9kTuwfwihuy9_1_1Xlw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZiuOUFavXP8VILg6KcvNOOfIPnIsUQdr--zFp1j3iMKfY8Utby0OFLvCbjweE85gWxIC-cUa7kc1lRebcHnzVUtp9Q22vXFEQ1HxOe6lgI-dAZaPdBcF4uXuuVFbdUFOeNP6Bwj_1I83lmquEOkETjq-GztsDk6ZgrpWM9_1brvrXgN7xM5_1PbobYK-RYP6afnA7fNWZEZw_1myB9y1Tmu9Cv5Ewe2o5WGvRhULISaB5EGweXWwHuhAge8qUxPkXDXvDCEuxQg4t0Bf70UVjtBRbREU9oGmw_1IAqQtfHYud6TGZviTmfkdRXW0gTSaWvktAOHvy09jkaHFFV9kTuwfwihuy9_1_1Xlw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZiuOUFavXP8VILg6KcvNOOfIPnIsUQdr--zFp1j3iMKfY8Utby0OFLvCbjweE85gWxIC-cUa7kc1lRebcHnzVUtp9Q22vXFEQ1HxOe6lgI-dAZaPdBcF4uXuuVFbdUFOeNP6Bwj_1I83lmquEOkETjq-GztsDk6ZgrpWM9_1brvrXgN7xM5_1PbobYK-RYP6afnA7fNWZEZw_1myB9y1Tmu9Cv5Ewe2o5WGvRhULISaB5EGweXWwHuhAge8qUxPkXDXvDCEuxQg4t0Bf70UVjtBRbREU9oGmw_1IAqQtfHYud6TGZviTmfkdRXW0gTSaWvktAOHvy09jkaHFFV9kTuwfwihuy9_1_1Xlw&gws_rd=ssl'
		];
		print_r($generated_search_img_results_urls);

		echo '<hr />$actual_ruslts_urls  : <br/><br/>';
		$actual_search_img_results_urls = [
			'https://www.google.com/search?tbs=sbi:AMhZZivMD3wnHikH-opZIU1xDeJxRUpjHf1_1HDIIEAxxsv5akuXQb0X43ew1B-KRiCM6CfGzaovYy-VPwsI75SujkEcAw0FxS9zBfdSXWz9rdPAFUbo7B21n335sCQfGVasJLhmLGJqqH6ByBeaKZGp8JJRo0iyD7_1FcqynWpkqGsaw6LwoIOp2ihcxiB1rq3tXOWkFFgbPG8EaGbHZ55jNfvrBQIXKN5GkTLdP2HcbwMcr97up2u2De23pTZMmBhhfjOO7kIjV7FUlhXYzyjYLAnQ5ioPpb6Skob7Gzcx64uHzltsnKrhq68Z7qPo_1n1hQ7v1RSpPvdX1i466Y4eL1k6HVax-I6vw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZivMD3wnHikH-opZIU1xDeJxRUpjHf1_1HDIIEAxxsv5akuXQb0X43ew1B-KRiCM6CfGzaovYy-VPwsI75SujkEcAw0FxS9zBfdSXWz9rdPAFUbo7B21n335sCQfGVasJLhmLGJqqH6ByBeaKZGp8JJRo0iyD7_1FcqynWpkqGsaw6LwoIOp2ihcxiB1rq3tXOWkFFgbPG8EaGbHZ55jNfvrBQIXKN5GkTLdP2HcbwMcr97up2u2De23pTZMmBhhfjOO7kIjV7FUlhXYzyjYLAnQ5ioPpb6Skob7Gzcx64uHzltsnKrhq68Z7qPo_1n1hQ7v1RSpPvdX1i466Y4eL1k6HVax-I6vw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZiuOUFavXP8VILg6KcvNOOfIPnIsUQdr--zFp1j3iMKfY8Utby0OFLvCbjweE85gWxIC-cUa7kc1lRebcHnzVUtp9Q22vXFEQ1HxOe6lgI-dAZaPdBcF4uXuuVFbdUFOeNP6Bwj_1I83lmquEOkETjq-GztsDk6ZgrpWM9_1brvrXgN7xM5_1PbobYK-RYP6afnA7fNWZEZw_1myB9y1Tmu9Cv5Ewe2o5WGvRhULISaB5EGweXWwHuhAge8qUxPkXDXvDCEuxQg4t0Bf70UVjtBRbREU9oGmw_1IAqQtfHYud6TGZviTmfkdRXW0gTSaWvktAOHvy09jkaHFFV9kTuwfwihuy9_1_1Xlw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZiuOUFavXP8VILg6KcvNOOfIPnIsUQdr--zFp1j3iMKfY8Utby0OFLvCbjweE85gWxIC-cUa7kc1lRebcHnzVUtp9Q22vXFEQ1HxOe6lgI-dAZaPdBcF4uXuuVFbdUFOeNP6Bwj_1I83lmquEOkETjq-GztsDk6ZgrpWM9_1brvrXgN7xM5_1PbobYK-RYP6afnA7fNWZEZw_1myB9y1Tmu9Cv5Ewe2o5WGvRhULISaB5EGweXWwHuhAge8qUxPkXDXvDCEuxQg4t0Bf70UVjtBRbREU9oGmw_1IAqQtfHYud6TGZviTmfkdRXW0gTSaWvktAOHvy09jkaHFFV9kTuwfwihuy9_1_1Xlw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZiuOUFavXP8VILg6KcvNOOfIPnIsUQdr--zFp1j3iMKfY8Utby0OFLvCbjweE85gWxIC-cUa7kc1lRebcHnzVUtp9Q22vXFEQ1HxOe6lgI-dAZaPdBcF4uXuuVFbdUFOeNP6Bwj_1I83lmquEOkETjq-GztsDk6ZgrpWM9_1brvrXgN7xM5_1PbobYK-RYP6afnA7fNWZEZw_1myB9y1Tmu9Cv5Ewe2o5WGvRhULISaB5EGweXWwHuhAge8qUxPkXDXvDCEuxQg4t0Bf70UVjtBRbREU9oGmw_1IAqQtfHYud6TGZviTmfkdRXW0gTSaWvktAOHvy09jkaHFFV9kTuwfwihuy9_1_1Xlw&gws_rd=ssl'
			,
			'https://www.google.com/search?tbs=sbi:AMhZZiuOUFavXP8VILg6KcvNOOfIPnIsUQdr--zFp1j3iMKfY8Utby0OFLvCbjweE85gWxIC-cUa7kc1lRebcHnzVUtp9Q22vXFEQ1HxOe6lgI-dAZaPdBcF4uXuuVFbdUFOeNP6Bwj_1I83lmquEOkETjq-GztsDk6ZgrpWM9_1brvrXgN7xM5_1PbobYK-RYP6afnA7fNWZEZw_1myB9y1Tmu9Cv5Ewe2o5WGvRhULISaB5EGweXWwHuhAge8qUxPkXDXvDCEuxQg4t0Bf70UVjtBRbREU9oGmw_1IAqQtfHYud6TGZviTmfkdRXW0gTSaWvktAOHvy09jkaHFFV9kTuwfwihuy9_1_1Xlw&gws_rd=ssl'
		];		
		print_r($actual_search_img_results_urls);

		

		die;


	}	



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

		$res = app(Web::class)->get($url);

		//echo '<pre>';	
		//echo $res->getStatusCode(); // 200
		//echo $res->getHeaderLine('content-type'); 
		echo $res->getBody(); 

		//die;	
	}



}
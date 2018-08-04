<?php

namespace App\Processes\Adapters\Google\Traits;

// use App\Lib\Vendor\Goutte\GoutteExtension as Spider;
// use App\Lib\Vendor\Guzzle\GuzzleExtension as Web;
use App\Lib\Vendor\Symfony\DomCrawler\CrawlerExtension as Crawler;


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
 *  TODO:
 * --------------------------------------------------------------------------
 * 
 */



/**
 * Google Reverse Image Search
 * 
 * (properties prefix : GRIS)
 */
trait GReverseImage {
	

	/**
	 * Revenrse image search endpoint
	 */
	protected $gris_endpoint = 'http://images.google.com/searchbyimage';	
	

	/**
	 * Google Reverse Image Search (GRIS)
	 *   
	 * 
	 * @param string $img_src_url // the image src url to prerform reverse search with
	 * @param array $query // other query params
	 * @return mixed
	 */
	public function grisSearch($img_src_url, $query=[])
	{		
		$query['image_url'] = $img_src_url;

		$search_url = $this->gris_endpoint . '?' . http_build_query($query);

		$html		= $this->grisCurlRequest($search_url);
		
		$crawler 	= new Crawler($html);
		
		$links = $crawler->filter('body h3.r > a')->each(function ($node, $i) {
			return [
				'href' => $node->attr('href'), 
				'text' => $node->text()
			];
		});	  
			
		return $links;
	}	


	/**
	 * Google reverse image search request
	 * 
	 * @param string $url 
	 */
    protected function grisCurlRequest($url)
    {		
		$curl = curl_init();
		curl_setopt_array($curl,[
			CURLOPT_URL 			=> $url,
			CURLOPT_HEADER 			=> 0,
			CURLOPT_RETURNTRANSFER 	=> 1,
			CURLOPT_SSL_VERIFYPEER 	=> false,
			CURLOPT_FOLLOWLOCATION 	=> true,
			CURLOPT_REFERER 		=> 'http://localhost',
			CURLOPT_USERAGENT 		=> 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',			
		]);		
		$content = utf8_decode(curl_exec($curl));		
		curl_close($curl);
		
		return $content;
    }		
}
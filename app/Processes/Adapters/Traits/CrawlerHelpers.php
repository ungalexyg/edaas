<?php

namespace App\Processes\Adapters\Traits;


// https://symfony.com/doc/current/components/dom_crawler.html

trait CrawlerHelpers {

   
    /**
     *  Get links from body
     */
    public function getLinksFromBody($crawler) 
    {
		return $crawler->filter('body a')->each(function ($node, $i) {
			return ['href' => $node->attr('href'), 'text' => $node->text()];
		});		
    }  


}
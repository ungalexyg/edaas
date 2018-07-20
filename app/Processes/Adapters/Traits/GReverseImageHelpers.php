<?php

namespace App\Processes\Adapters\Traits;


// http://skyzerblogger.blogspot.com/2013/01/google-reverse-image-search-scraping.html

trait GReverseImageHelpers {
    

    
    ###################################
    # Core 
    ###################################

    function open_url($full_url, $referer='http://www.kaizern.com')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $full_url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($curl, CURLOPT_REFERER, 'http://www.kaizern.com');
        curl_setopt($curl, CURLOPT_REFERER, $referer);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11");
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $content = utf8_decode(curl_exec($curl));
        curl_close($curl);
        return $content;
    }    

    function get_tag_content_as_dom($img_res_url, $tag_name = 'body')
    {
        $dom = new \DOMDocument();
        $dom->strictErrorChecking = false;  // turn off warnings and errors when parsing
        @$dom->loadHTML($img_res_url);
        $body = $dom->getElementsByTagName($tag_name);
        $body = $body->item(0);
        $new_dom = new \DOMDocument();
        $node = $new_dom->importNode($body, true);
        $new_dom->appendChild($node);
        return $new_dom;
 
    }

    ###################################
    # Helpers 
    ###################################    


    function get_html_contents($full_url) {
        return str_get_html($full_url); // simplehtmldom's function
    }

    function get_full_result_block($html) {
        return $html->find('div#center_col', 0);
    }

    function get_topstuff($whole_result) {
        return $whole_result->find('div#topstuff', 0);
    }

    function get_best_guess($topstuff) {
        $best_guess = $this->strstr_after($topstuff->plaintext, 'Best guess for this image:');
        return trim($best_guess, ' ');
    }

    function get_titles_dom($whole_search_result_block) {
        return $whole_search_result_block->find('div#search div#ires ol#rso li.g h3.r');
    }

    function get_span_texts_dom($whole_search_result_block) {
        return $whole_search_result_block->find('div#search div#ires ol#rso li.g span.st');
    }

    function get_first_title($titles_dom) {
        $results_count = count($titles_dom);
        for ($i = 0; $i < $results_count; $i++) {
            $title = $this->filter_out_bad_words($titles_dom[$i]->plaintext);
            if ($title === 'Visually similar images') return null;
            if (str_word_count($title) == 1 & $i + 1 != $results_count) {
                $title .= " ".$this->filter_out_bad_words($titles_dom[$i + 1]->plaintext);
            } else {
                return $title;
            }
        }
        return null;
    }

    function get_first_span_text($span_texts_dom) {
        $results_count = count($span_texts_dom);
        for ($i = 0; $i < $results_count; $i++) {
            $span_text = $this->filter_out_bad_words($span_texts_dom[$i]->plaintext);
            if ($span_text === 'Visually similar images') return null;
            if ($span_text) return $span_text;
        }
        return null;
    }
    
    

}
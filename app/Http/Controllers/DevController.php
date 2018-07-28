<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Lib\Embed\Embed;
use App\Processes\Scanner;


class DevController extends Controller
{

    /**
     * Example google custom search
     */
    public function search()
    {
        $res = app(Scanner::class)->gcseSearch("Baby Groot Flowerpot");
        
        echo $res->getBody();
    }

    /**
     * Example reverse image search
     */
    public function imageSearch()
    {
        $img_src_url = "https://ae01.alicdn.com/kf/HTB1RrfMjCYTBKNjSZKbq6xJ8pXai/T-Shirt-Women-Summer-Short-Sleeve-V-Neck-t-shirt-Female-Cactus-Funny-Letter-Print-T.jpg";

        // add extra query params
        $query = [
			'q' => 'site:bellelily.com', // optional, get results for that image only in specific site
        ];
        
        $results = app(Scanner::class)->grisSearch($img_src_url, $query);
        
        dd($results);
    }


    /**
     * Test mongo
     *
     * @return \Illuminate\Http\Response
     */
    public function mongo()
    {
        $data = Test::all();
        echo '<pre>';
        var_dump($data[0]->key);
        die;
    }


   
}

<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Lib\Collector\Core\Embed;
use App\Lib\Collector\Adapters\GCSE;

class DevController extends Controller
{
    /**
     * Display a listing of the resource.
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


    /**
     * Fetch site
     *
     * @return \Illuminate\Http\Response
     */
    public function collect()
    {
        
        //Load any url:
        $info = Embed::create('https://www.facebook.com/britneyspears/posts/10156109832173234');
        
        $out = [ 
        
            'title' =>  $info->title, //The page title
            'description' =>  $info->description, //The page description
            'url' =>  $info->url, //The canonical url
            'type' =>  $info->type, //The page type (link, video, image, rich)
            'tags' =>  $info->tags, //The page keywords (tags)
        
            'images' =>  $info->images, //List of all images found in the page
            'image' =>  $info->image, //The image choosen as main image
            'imageWidth' =>  $info->imageWidth, //The width of the main image
            'imageHeight' =>  $info->imageHeight, //The height of the main image
        
            'code' =>  $info->code, //The code to embed the image, video, etc
            'width' =>  $info->width, //The width of the embed code
            'height' =>  $info->height, //The height of the embed code
            'aspectRatio' =>  $info->aspectRatio, //The aspect ratio (width/height)
        
            'authorName' =>  $info->authorName, //The resource author
            'authorUrl' =>  $info->authorUrl, //The author url
        
            'providerName' =>  $info->providerName, //The provider name of the page (Youtube, Twitter, Instagram, etc)
            'providerUrl' =>  $info->providerUrl, //The provider url
            'providerIcons' =>  $info->providerIcons, //All provider icons found in the page
            'providerIcon' =>  $info->providerIcon, //The icon choosen as main icon
        
            'publishedDate' =>  $info->publishedDate, //The published date of the resource
            'license' =>  $info->license, //The license url of the resource
            'linkedData' =>  $info->linkedData, //The linked-data info (http://json-ld.org/)
            'feeds' =>  $info->feeds, //The RSS/Atom feeds
        ];
        
        foreach($out as $key => $val) 
        {
            echo "<h1>$key</h1>";
            if(is_array($val)) 
            {
                echo "<div>";
                print_r($val);
                echo "</div>";
            }
            else 
            {
                echo "<div>$val</div>";
            }
            echo "<hr />";
        }


    }


    public function gimages()
    {
       app(GCSE::class)->search("Baby Groot Flowerpot");
       //app(GCSE::class)->search("Sunglasses");
       //die("\n END");
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}

<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class Flickr extends EndPoint implements EndPointInterface
{
    protected static $pattern = 'www.flickr.com/*';
    protected static $endPoint = 'http://flickr.com/services/oembed';
}

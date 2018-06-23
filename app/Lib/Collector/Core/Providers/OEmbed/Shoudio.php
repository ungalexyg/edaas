<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class Shoudio extends EndPoint implements EndPointInterface
{
    protected static $pattern = 'shoudio.com/*';
    protected static $endPoint = 'http://shoudio.com/api/oembed';
}

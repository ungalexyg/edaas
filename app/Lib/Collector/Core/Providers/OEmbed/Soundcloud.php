<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class Soundcloud extends EndPoint implements EndPointInterface
{
    protected static $pattern = 'soundcloud.com/*';
    protected static $endPoint = 'http://soundcloud.com/oembed';
}

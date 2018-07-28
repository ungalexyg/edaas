<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class Youtube extends EndPoint implements EndPointInterface
{
    protected static $pattern = '*youtube.*';
    protected static $endPoint = 'http://www.youtube.com/oembed';
}

<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class Ustream extends EndPoint implements EndPointInterface
{
    protected static $pattern = 'www.ustream.tv/*';
    protected static $endPoint = 'http://www.ustream.tv/oembed';
}

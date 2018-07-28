<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class Dotsub extends EndPoint implements EndPointInterface
{
    protected static $pattern = 'dotsub.com/view/*';
    protected static $endPoint = 'http://dotsub.com/services/oembed';
}

<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class Polldaddy extends EndPoint implements EndPointInterface
{
    protected static $pattern = 'polldaddy.com/poll/*';
    protected static $endPoint = 'http://polldaddy.com/oembed';
}

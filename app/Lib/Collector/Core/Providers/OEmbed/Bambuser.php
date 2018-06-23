<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class Bambuser extends EndPoint implements EndPointInterface
{
    protected static $pattern = 'bambuser.com/v/*';
    protected static $endPoint = 'https://api.bambuser.com/oembed.json';
}

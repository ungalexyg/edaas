<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class WordPress extends EndPoint implements EndPointInterface
{
    protected static $pattern = 'wordpress.tv/*';
    protected static $endPoint = 'https://wordpress.tv/oembed';
}

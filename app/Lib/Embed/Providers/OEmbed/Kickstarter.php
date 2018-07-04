<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

class Kickstarter extends EndPoint implements EndPointInterface
{
    protected static $pattern = 'www.kickstarter.com/*';
    protected static $endPoint = 'http://www.kickstarter.com/services/oembed';
}

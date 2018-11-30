<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

use App\Lib\Collector\Core\Http\Url;

class Spotify extends EndPoint implements EndPointInterface
{
    protected static $pattern = '*.spotify.com/*';
    protected static $endPoint = 'https://embed.spotify.com/oembed';

    /**
     * {@inheritdoc}
     */
    public function getEndPoint()
    {
        return Url::create(static::$endPoint)
                ->withQueryParameters([
                    'url' => (string) $this->response->getUrl()->withQueryParameters([]),
                    'format' => 'json'
                ]);
    }
}

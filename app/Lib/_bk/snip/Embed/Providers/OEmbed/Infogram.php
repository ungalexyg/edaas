<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

use App\Lib\Collector\Core\Http\Url;

class Infogram extends EndPoint implements EndPointInterface
{
    protected static $pattern = [
        'infogr.am/*',
        'www.infogr.am/*',
    ];
    protected static $endPoint = 'https://infogr.am/oembed';

        /**
     * {@inheritdoc}
     */
    public function getEndPoint()
    {
        $url = $this->response->getUrl()->withScheme('https');

        return Url::create(static::$endPoint)
                ->withQueryParameters([
                    'url' => (string) $url,
                ]);
    }
}

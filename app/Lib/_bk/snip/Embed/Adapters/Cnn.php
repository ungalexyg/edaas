<?php

namespace App\Lib\Collector\Core\Adapters;

use App\Lib\Collector\Core\Http\Response;
use App\Lib\Collector\Core\Http\Url;
use App\Lib\Collector\Core\Utils;

/**
 * Adapter provider more information from cnn.com.
 */
class Cnn extends Webpage
{
    /**
     * {@inheritdoc}
     */
    public static function check(Response $response)
    {
        return $response->isValid() && $response->getUrl()->match([
            '*.cnn.com/videos/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        $url = Url::create('https://fave.api.cnn.io/v1/fav/')
            ->withQueryParameters([
                'video' => implode('/', $this->getResponse()->getUrl()->getSlicePath(1)),
                'customer' => 'cnn',
                'env' => 'prod'
            ]);

        $this->width = 416;
        $this->height = 234;

        return Utils::iframe($url, $this->width, $this->height);
    }
}

<?php

namespace App\Lib\Collector\Core\Adapters;

use App\Lib\Collector\Core\Http\Response;
use App\Lib\Collector\Core\Utils;

/**
 * Adapter to generate embed code from ideone.com.
 */
class Ideone extends Webpage
{
    /**
     * {@inheritdoc}
     */
    public static function check(Response $response)
    {
        return $response->isValid() && $response->getUrl()->match([
            'ideone.com/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        $this->width = null;
        $this->height = null;

        $url = $this->getResponse()->getUrl();
        $path = '/e.js'.$url->getPath();

        return Utils::script($url->getAbsolute($path));
    }
}

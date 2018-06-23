<?php

namespace App\Lib\Collector\Core\Adapters;

use App\Lib\Collector\Core\Utils;
use App\Lib\Collector\Core\Http\Response;

/**
 * Adapter to get the embed code from slides.com.
 */
class Slides extends Webpage
{
    /**
     * {@inheritdoc}
     */
    public static function check(Response $response)
    {
        return $response->isValid() && $response->getUrl()->match([
            'slides.com/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return Utils::iframe($this->getResponse()->getUrl()->withAddedPath('embed'), $this->width, $this->height);
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth()
    {
        return 576;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight()
    {
        return 420;
    }
}

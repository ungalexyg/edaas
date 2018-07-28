<?php

namespace App\Lib\Collector\Core\Adapters;

use App\Lib\Collector\Core\Http\Response;
use App\Lib\Collector\Core\Utils;
use App\Lib\Collector\Core\Providers\Api;

/**
 * Adapter to provide information from archive.org API.
 */
class Archive extends Webpage
{
    /**
     * {@inheritdoc}
     */
    public static function check(Response $response)
    {
        return $response->isValid() && $response->getUrl()->match([
            'archive.org/details/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        parent::init();

        $this->providers = ['archive' => new Api\Archive($this)] + $this->providers;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return Utils::iframe(str_replace('/details/', '/embed/', $this->url), $this->width, $this->height);
    }

    /**
     * {@inheritdoc}
     */
    public function getWidth()
    {
        return 640;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeight()
    {
        return 480;
    }
}

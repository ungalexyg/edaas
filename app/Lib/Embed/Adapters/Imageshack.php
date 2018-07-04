<?php

namespace App\Lib\Collector\Core\Adapters;

use App\Lib\Collector\Core\Http\Response;
use App\Lib\Collector\Core\Providers\Api;

/**
 * Adapter to provide information from imageshack.
 */
class Imageshack extends Webpage
{
    /**
     * {@inheritdoc}
     */
    public static function check(Response $response)
    {
        return $response->isValid() && $response->getUrl()->match([
            'imageshack.com/i/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        parent::init();

        $this->providers = ['imageshack' => new Api\Imageshack($this)] + $this->providers;
    }
}

<?php

namespace App\Lib\Collector\Core\Adapters;

use App\Lib\Collector\Core\Http\Response;
use App\Lib\Collector\Core\Utils;
use App\Lib\Collector\Core\Providers\Api;

/**
 * Adapter provider more information from some facebook pages.
 */
class Facebook extends Webpage
{
    /**
     * {@inheritdoc}
     */
    public static function check(Response $response)
    {
        return $response->isValid() && $response->getUrl()->match([
            'www.facebook.com/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        parent::init();

        $this->providers = ['facebook' => new Api\Facebook($this)] + $this->providers;
    }
}

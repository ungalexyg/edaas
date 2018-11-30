<?php

namespace App\Lib\Collector\Core\Adapters;

use App\Lib\Collector\Core\Http\Response;
use App\Lib\Collector\Core\Utils;

/**
 * Adapter to generate embed code from pastie.org.
 */
class Pastie extends Webpage
{
    /**
     * {@inheritdoc}
     */
    public static function check(Response $response)
    {
        return $response->isValid() && $response->getUrl()->match([
            'pastie.org/pastes/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        $this->width = null;
        $this->height = null;

        $path = '/'.$this->getResponse()->getUrl()->getDirectoryPosition(1).'.js';

        return Utils::script($this->getResponse()->getUrl()->getAbsolute($path));
    }
}

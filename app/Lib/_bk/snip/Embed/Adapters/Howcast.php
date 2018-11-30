<?php

namespace App\Lib\Collector\Core\Adapters;

use App\Lib\Collector\Core\Http\Response;
use App\Lib\Collector\Core\Utils;

/**
 * Adapter to get the embed code from howcast.com.
 */
class Howcast extends Webpage
{
    /**
     * {@inheritdoc}
     */
    public static function check(Response $response)
    {
        return $response->isValid() && $response->getUrl()->match([
            'www.howcast.com/videos/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        $this->width = null;
        $this->height = null;

        $dom = $this->getResponse()->getHtmlContent();
        // #embedModal textarea
        $textarea = Utils::xpathQuery($dom, "descendant-or-self::*[@id = 'embedModal']/descendant-or-self::*/textarea");
        
        if ($textarea) {
            return $textarea->nodeValue;
        }
    }
}

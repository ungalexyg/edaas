<?php

namespace App\Lib\Collector\Core\Providers\OEmbed;

use App\Lib\Collector\Core\Adapters\Adapter;
use App\Lib\Collector\Core\Http\Response;
use App\Lib\Collector\Core\Http\Url;

/**
 * Abstract class extended by other classes.
 */
abstract class EndPoint
{
    protected $response;
    protected static $pattern;
    protected static $endPoint;

    /**
     * {@inheritdoc}
     */
    public static function create(Adapter $adapter)
    {
        $response = $adapter->getResponse();

        if ($response->getUrl()->match(static::$pattern)) {
            return new static($response);
        }
    }

    /**
     * Constructor.
     *
     * @param Response $response
     */
    private function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndPoint()
    {
        return Url::create(static::$endPoint)
                ->withQueryParameters([
                    'url' => (string) $this->response->getUrl(),
                    'format' => 'json',
                ]);
    }
}

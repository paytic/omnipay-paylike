<?php

namespace ByTIC\Omnipay\Paylike\Tests\Message;

use ByTIC\Omnipay\Paylike\Message\AbstractRequest;
use ByTIC\Omnipay\Paylike\Tests\AbstractTest;
use Guzzle\Http\Client as HttpClient;
use Omnipay\Common\Message\AbstractResponse;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractResponseTest
 * @package ByTIC\Omnipay\Paylike\Tests\Message
 */
abstract class AbstractResponseTest extends AbstractTest
{
    /**
     * @param string $class Request Class
     * @param array $data
     * @return AbstractResponse|\Omnipay\Common\Message\ResponseInterface
     */
    protected function newResponse($class, $data = [])
    {
        $client = $this->getHttpClient();
        $request = HttpRequest::createFromGlobals();
        /** @var AbstractRequest $request */
        $request = new $class($client, $request);
        if ($request->sendData($data)) {
            return $request->getResponse();
        }
        return null;
    }
}

<?php

namespace ByTIC\Omnipay\Paylike\Tests\Message;

//use ByTIC\Omnipay\Paylike\Tests\Traits\HasTestUtilMethods;
use ByTIC\Omnipay\Paylike\Message\AbstractRequest;
use ByTIC\Omnipay\Paylike\Tests\AbstractTest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractRequestTest
 * @package ByTIC\Omnipay\Paylike\Tests\Message
 */
abstract class AbstractRequestTest extends AbstractTest
{
    /**
     * @param string $class
     * @param array $data
     * @return AbstractRequest
     */
    protected function newRequestWithInitTest($class, $data)
    {
        $request = $this->newRequest($class);
        self::assertInstanceOf($class, $request);
        $request->initialize($data);
        return $request;
    }

    /**
     * @param string $class
     * @return AbstractRequest
     */
    protected function newRequest($class)
    {
        $client = $this->getHttpClient();
        $request = HttpRequest::createFromGlobals();
        $request = new $class($client, $request);
        return $request;
    }
}

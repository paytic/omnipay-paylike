<?php

namespace Paytic\Omnipay\Paylike\Tests\Fixtures;

use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class HttpRequestBuilder
 * @package Paytic\Omnipay\Paylike\Tests\Fixtures
 */
class HttpRequestBuilder
{
    /**
     * @return HttpRequest
     */
    public static function createCompletePurchase()
    {
        $request = self::create();
        $request->query->add(['id' => 99999, 'orderId' => 99999, 'pTransactionId' => '5f5b8135e2412a5baa857c61']);

        return $request;
    }

    /**
     * @return HttpRequest
     */
    public static function create()
    {
        $request = new HttpRequest();

        return $request;
    }
}

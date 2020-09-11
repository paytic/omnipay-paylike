<?php

namespace ByTIC\Omnipay\Paylike\Tests;

use ByTIC\Omnipay\Paylike\Gateway;
use ByTIC\Omnipay\Paylike\Message\PurchaseRequest;

/**
 * Class HelperTest
 * @package ByTIC\Omnipay\Paylike\Tests
 */
class GatewayTest extends AbstractTest
{
    public function test_getApiUrl()
    {
        $gateway = new Gateway();

        // INITIAL TEST MODE IS TRUE
        self::assertEquals(
            'https://api.Paylike.com',
            $gateway->getApiUrl()
        );
    }

    public function testPurchaseRequestEndpointUrl()
    {
        $gateway = new Gateway();

        $request = $gateway->purchase();
        self::assertInstanceOf(PurchaseRequest::class, $request);
    }
}

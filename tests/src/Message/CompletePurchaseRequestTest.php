<?php

namespace ByTIC\Omnipay\Paylike\Tests\Message;

use ByTIC\Omnipay\Paylike\Message\CompletePurchaseRequest;
use ByTIC\Omnipay\Paylike\Message\CompletePurchaseResponse;
use ByTIC\Omnipay\Paylike\Tests\Fixtures\HttpRequestBuilder;
use Omnipay\Common\Http\Client;

/**
 * Class CompletePurchaseRequestTest
 * @package ByTIC\Omnipay\Mobilpay\Tests\Message
 */
class CompletePurchaseRequestTest extends AbstractRequestTest
{
    public function testSimpleSend()
    {
        $client = new Client();
        $httpRequest = HttpRequestBuilder::createCompletePurchase();
        $request = new CompletePurchaseRequest($client, $httpRequest);
        $request->initialize(
            [
                'publicKey' => getenv('PAYLIKE_PUBLIC_KEY'),
                'privateKey' => getenv('PAYLIKE_PRIVATE_KEY')
            ]
        );

        /** @var CompletePurchaseResponse $response */
        $response = $request->send();
        self::assertInstanceOf(CompletePurchaseResponse::class, $response);
        self::assertTrue($response->isSuccessful());
        self::assertSame($httpRequest->query->get('orderId'), $response->getData());
    }
}

<?php

namespace Paytic\Omnipay\Paylike\Tests\Message;

use Paytic\Omnipay\Paylike\Message\CompletePurchaseRequest;
use Paytic\Omnipay\Paylike\Message\CompletePurchaseResponse;
use Paytic\Omnipay\Paylike\Tests\Fixtures\HttpRequestBuilder;

/**
 * Class CompletePurchaseRequestTest
 * @package Paytic\Omnipay\Paylike\Tests\Message
 */
class CompletePurchaseRequestTest extends AbstractRequestTest
{
    public function testSimpleSend()
    {
        $client = $this->getHttpClient();
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

        $data = $response->getData();
        self::assertIsArray($data);
        self::assertTrue($data['success']);
        self::assertArrayHasKey('transaction', $data);
    }
}

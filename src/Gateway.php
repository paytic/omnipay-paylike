<?php

namespace ByTIC\Omnipay\Paylike;

use ByTIC\Omnipay\Paylike\Message\CompletePurchaseRequest;
use ByTIC\Omnipay\Paylike\Message\PurchaseRequest;
use ByTIC\Omnipay\Paylike\Message\ServerCompletePurchaseRequest;
use ByTIC\Omnipay\Paylike\Traits\HasKeysTrait;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

/**
 * @method RequestInterface authorize(array $options = [])
 * @method RequestInterface completeAuthorize(array $options = [])
 * @method RequestInterface capture(array $options = [])
 * @method RequestInterface refund(array $options = [])
 * @method RequestInterface void(array $options = [])
 * @method RequestInterface createCard(array $options = [])
 * @method RequestInterface updateCard(array $options = [])
 * @method RequestInterface deleteCard(array $options = [])
 */
class Gateway extends AbstractGateway
{
    use HasKeysTrait;

    CONST VERSION = '1.0';

    /**
     * @var string
     */
    private $prodApiHost = 'https://api.Paylike.com';


    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Paylike';
    }

    // ------------ REQUESTS ------------ //

    /**
     * @inheritdoc
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            PurchaseRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     *
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'testMode' => true, // Must be the 1st in the list!
            'publicKey' => $this->getPublicKey(),
            'privateKey' => $this->getPrivateKey(),
            'apiUrl' => $this->getApiUrl()
        ];
    }

    // ------------ PARAMETERS ------------ //

    /**
     * @param  boolean $value
     * @return $this|AbstractGateway
     */
    public function setTestMode($value)
    {
        $this->parameters->remove('apiUrl');
        $this->parameters->remove('secureUrl');
        return parent::setTestMode($value);
    }

    // ------------ Getter'n'Setters ------------ //

    /**
     * Get live- or testURL.
     */
    public function getApiUrl()
    {
        $defaultUrl = $this->getTestMode() === false
            ? $this->prodApiHost
            : $this->prodApiHost;
        return $this->parameters->get('apiUrl', $defaultUrl);
    }

    /**
     * @inheritdoc
     * @return CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            CompletePurchaseRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    /**
     * @inheritdoc
     */
    public function serverCompletePurchase(array $parameters = []): RequestInterface
    {
//        return $this->createRequest(
//            ServerCompletePurchaseRequest::class,
//            array_merge($this->getDefaultParameters(), $parameters)
//        );
    }

    /**
     * @param $value
     * @return $this
     */
    public function setApiUrl($value)
    {
        return $this->setParameter('apiUrl', $value);
    }
}

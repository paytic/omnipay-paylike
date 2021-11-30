<?php

namespace Paytic\Omnipay\Paylike\Message;

/**
 * Class PurchaseRequest
 * @package Paytic\Omnipay\Paylike\Message
 *
 * @method PurchaseResponse send()
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function initialize(array $parameters = [])
    {
        $parameters['identifier'] = isset($parameters['identifier']) ?
            $parameters['identifier'] : 'anonymous' . microtime(true);

        return parent::initialize($parameters);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'publicKey',
            'amount',
            'currency',
            'description',
            'orderId',
            'returnUrl',
            'card'
        );

        $data = [
            'publicKey' => $this->getPublicKey(),
            'returnUrl' => $this->getReturnUrl(),
            'identifier' => $this->getIdentifier(),
            'orderId' => $this->getOrderId(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'clientIp' => $this->getClientIp(),
        ];

        $card = $this->getCard();

        $data['firstName'] = $card->getBillingFirstName();
        $data['lastName'] = $card->getBillingLastName();
        $data['address'] = $card->getBillingAddress1();
        $data['phone'] = $card->getBillingPhone();
        $data['email'] = $card->getEmail();

        return $data;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->getParameter('identifier');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setIdentifier($value)
    {
        return $this->setParameter('identifier', $value);
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getParameter('title');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setTitle($value)
    {
        return $this->setParameter('title', $value);
    }
}

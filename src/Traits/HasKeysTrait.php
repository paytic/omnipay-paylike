<?php

namespace Paytic\Omnipay\Paylike\Traits;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

/**
 * Trait HasKeysTrait
 * @package Paytic\Omnipay\Paylike\Traits
 */
trait HasKeysTrait
{
    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->getParameter('privateKey');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setPrivateKey($value)
    {
        return $this->setParameter('privateKey', $value);
    }

    /**
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->getParameter('publicKey');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setPublicKey($value)
    {
        return $this->setParameter('publicKey', $value);
    }
}

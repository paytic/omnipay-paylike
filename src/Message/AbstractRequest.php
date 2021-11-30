<?php

namespace Paytic\Omnipay\Paylike\Message;

use Paytic\Omnipay\Common\Message\Traits\SendDataRequestTrait;
use Paytic\Omnipay\Paylike\Traits\HasKeysTrait;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

/**
 * Class AbstractRequest
 * @package Paytic\Omnipay\Paylike\Message
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use SendDataRequestTrait;
    use HasKeysTrait;

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->getParameter('apiUrl');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setApiUrl($value)
    {
        return $this->setParameter('apiUrl', $value);
    }
}

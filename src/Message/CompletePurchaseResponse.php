<?php

namespace Paytic\Omnipay\Paylike\Message;

use Paytic\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;
use Paytic\Omnipay\Common\Message\Traits\HtmlResponses\ConfirmHtmlTrait;

/**
 * Class CompletePurchaseResponse
 * @package Paytic\Omnipay\Paylike\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    use ConfirmHtmlTrait;
    use GatewayNotificationResponseTrait;

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return 'Error authorising payment';
        }

        return parent::getMessage();
    }
}

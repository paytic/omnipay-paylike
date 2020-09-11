<?php

namespace ByTIC\Omnipay\Paylike\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;

/**
 * Class CompletePurchaseRequest
 * @package ByTIC\Omnipay\Paylike\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use GatewayNotificationRequestTrait;

    /**
     * @return mixed
     */
    protected function isValidNotification()
    {
        $this->validate('privateKey');

        return $this->hasGet('pTransactionId') && $this->isValidTransaction();
    }

    /**
     * @return bool|mixed
     */
    protected function parseNotification()
    {
        $data = $this->getDataItem('transaction');

        return $data;
    }

    /**
     * @return bool
     */
    protected function isValidTransaction()
    {
        $transactionId = $this->httpRequest->query->get('pTransactionId');
        $this->setTransactionId($transactionId);

        $isValid = false;
        try {
            $paylike = new \Paylike\Paylike($this->getPrivateKey());
            $transactions = $paylike->transactions();
            $transaction = $transactions->fetch($transactionId);
            if (is_array($transaction)) {
                $this->setDataItem('transaction', $transaction);
                $isValid = true;
            }
        } catch (\Paylike\Exception\NotFound $e) {
            $this->setDataItem('message', "The transaction was not found");
        } catch (\Paylike\Exception\ApiException $e) {
            $this->setDataItem('message', "Api Error:" . $e->getMessage());
        }

        if ($isValid) {
            $this->setDataItem('success', true);
        }
        return $isValid;
    }
}

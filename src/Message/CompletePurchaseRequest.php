<?php

namespace ByTIC\Omnipay\Paylike\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\Paylike\Traits\HasApiTrait;

/**
 * Class CompletePurchaseRequest
 * @package ByTIC\Omnipay\Paylike\Message
 *
 * @method CompletePurchaseResponse send()
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use GatewayNotificationRequestTrait;
    use HasApiTrait;

    /**
     * @return mixed
     */
    public function isValidNotification()
    {
        if (!$this->hasGet('pTransactionId')) {
            return false;
        }
        $this->validate('privateKey');

        return $this->isValidTransaction();
    }

    /**
     * @return bool|mixed
     */
    protected function parseNotification()
    {
        $transaction = $this->getDataItem('transaction');

        if ($transaction['pendingAmount'] > 0) {
            $transaction = $this->makeCaptureRequest(
                [
                    'amount' => $transaction['pendingAmount'] / 100,
                    'currency' => $transaction['currency'],
                ]
            );
        }

        return $transaction;
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
            $transactions = $this->getApi()->transactions();
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

    /**
     * @param array $parameters
     * @return array
     */
    protected function makeCaptureRequest(array $parameters)
    {
        $request = new CaptureRequest($this->httpClient, $this->httpRequest);
        $request->initialize(array_replace($this->getParameters(), $parameters));
        $response = $request->send();
        return $response->getDataProperty('transaction');
    }
}

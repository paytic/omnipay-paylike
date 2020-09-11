<?php

namespace ByTIC\Omnipay\Paylike\Message;

use ByTIC\Omnipay\Paylike\Traits\HasApiTrait;

/**
 * Class CaptureRequest
 * @package ByTIC\Omnipay\Paylike\Message
 *
 * @method CaptureResponse send
 */
class CaptureRequest extends AbstractRequest
{
    use HasApiTrait;

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('privateKey', 'transactionId', 'amount');

        $data = ['success' => false];

        try {
            $transactions = $this->getApi()->transactions();
            $transaction = $transactions->capture(
                $this->getTransactionId(),
                [
                    'amount' => $this->getAmount() * 100,
//                    'currency' => 'EUR'
                ]
            );
            if (is_array($transaction)) {
                $data['transaction'] = $transaction;
                $data['success'] = true;
            }
        } catch (\Paylike\Exception\NotFound $e) {
            $data['message'] = "The transaction was not found";
        } catch (\Paylike\Exception\ApiException $e) {
            $data['message'] = "Api Error:" . $e->getMessage();
        }

        return $data;
    }
}
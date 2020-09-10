<?php

namespace ByTIC\Omnipay\Paylike\Message;

use ByTIC\Omnipay\Common\Message\Traits\HasViewTrait;
use ByTIC\Omnipay\Paylike\Helper;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Paylike\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    use HasViewTrait;


    protected function initViewVars()
    {
        $data = $this->getData();
        $this->getView()->with($data);
    }

    /**
     * @inheritDoc
     */
    protected function generateViewPath()
    {
        return Helper::viewsPath();
    }

    /**
     * @return string
     */
    protected function getViewFile()
    {
        return 'purchase';
    }
}

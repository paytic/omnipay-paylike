<?php

namespace ByTIC\Omnipay\Paylike\Traits;

/**
 * Trait HasApiTrait
 * @package ByTIC\Omnipay\Paylike\Traits
 *
 * @method string getPrivateKey
 */
trait HasApiTrait
{
    /**
     * @var null|\Paylike\Paylike
     */
    protected $api = null;

    /**
     * @return \Paylike\Paylike
     */
    public function getApi()
    {
        if ($this->api == null) {
            $this->initApi();
        }
        return $this->api;
    }

    protected function initApi()
    {
        $this->api = $this->generateApi();
    }

    /**
     * @return \Paylike\Paylike
     * @throws \Paylike\Exception\ApiException
     */
    protected function generateApi()
    {
        return new \Paylike\Paylike($this->getPrivateKey());
    }
}

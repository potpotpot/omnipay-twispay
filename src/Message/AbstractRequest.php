<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

abstract class AbstractRequest extends CommonAbstractRequest
{

//    public function __construct(ClientInterface $httpClient, HttpRequest $httpRequest)
//    {
//        parent::__construct($httpClient, $httpRequest);
//
//        $this->httpRequest->setAuth($this->getApiAuthToken());
//        $this->httpRequest->setHeader('Content-type', 'application/json');
//        $this->httpRequest->addHeader('Accept', 'application/json');
//    }

    /**
     * Get live- or testURL.
     */
    public function getUrl()
    {
        if ($this->getTestMode()) {
            return 'https://api-stage.twispay.com';
        } else {
            return 'https://https://api.twispay.com';
        }
    }

    public function getApiAuthToken()
    {
        return $this->getParameter('apiKey') . ':';
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getSiteId()
    {
        return $this->getParameter('siteId');
    }

    public function setSiteId($value)
    {
        return $this->setParameter('siteId', $value);
    }
}

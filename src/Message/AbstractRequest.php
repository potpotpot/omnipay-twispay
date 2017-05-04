<?php

namespace Omnipay\Twispay\Message;

use Guzzle\Http\ClientInterface;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractRequest extends CommonAbstractRequest
{
//
//    public function __construct(ClientInterface $httpClient, Request $httpRequest)
//    {
//
////        $httpRequest->setAuth($this->getApiAuthToken());
////        $httpRequest->setHeader('Content-type', 'application/json');
////        $httpRequest->addHeader('Accept', 'application/json');
//        parent::__construct($httpClient, $httpRequest);
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

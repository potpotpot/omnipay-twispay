<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

abstract class AbstractRequest extends CommonAbstractRequest
{
    /**
     * @param null $uri
     * @param null $headers
     * @param array $options
     *
     * @return \Guzzle\Http\Message\RequestInterface
     * @throws \Guzzle\Http\Exception\RequestException
     */
    public function get($uri = null, $headers = null, $options = [])
    {
        $request = $this->httpClient->get(
            $this->getUrl() . $uri,
            $headers,
            $options
        );
        $request->setAuth($this->getApiAuthToken());
        $request->setHeader('Content-type', 'application/json');
        $request->addHeader('Accept', 'application/json');

        return $request;
    }

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

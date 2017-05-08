<?php

namespace Omnipay\Twispay\Message;

use Guzzle\Http\Client;
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
        /** @var Client $client */
        $client = $this->httpClient;
        $request = $client->get(
            $this->getParameter('apiUrl') . $uri,
            $headers,
            $options
        );
        $request->setAuth($this->getApiAuthToken());
        $request->setHeader('Content-type', 'application/json');
        $request->addHeader('Accept', 'application/json');

        return $request;
    }

    /**
     * @param null $uri
     * @param null $headers
     * @param array $options
     *
     * @return \Guzzle\Http\Message\EntityEnclosingRequestInterface
     * @throws \Guzzle\Http\Exception\RequestException
     */
    public function post($uri = null, $headers = null, $options = [])
    {
        $request = $this->httpClient->post(
            $this->getParameter('apiUrl') . $uri,
            $headers,
            $options
        );
        $request->setAuth($this->getApiAuthToken());
        $request->setHeader('Content-type', 'application/json');
        $request->addHeader('Accept', 'application/json');

        return $request;
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

    public function getApiUrl()
    {
        return $this->getParameter('apiUrl');
    }

    public function setApiUrl($value)
    {
        return $this->setParameter('apiUrl', $value);
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

<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\ResponseInterface;

class FetchOrdersRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = '/order';

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        return [];
    }

    public function sendData($data)
    {
        $request = $this->httpClient->get($this->getUrl() . $this->endpoint);
        $request->setAuth($this->getApiAuthToken());
        $request->setHeader('Content-type', 'application/json');
        $request->addHeader('Accept', 'application/json');

        $httpResponse = $request->send();

        return $this->response = new FetchOrdersResponse($this, $httpResponse->json());
    }
}

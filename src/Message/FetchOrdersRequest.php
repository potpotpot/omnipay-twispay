<?php

namespace Omnipay\Twispay\Message;

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
        $httpResponse = $this->get($this->endpoint)->send();

        return $this->response = new FetchOrdersResponse($this, $httpResponse->json());
    }
}

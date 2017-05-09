<?php

namespace Omnipay\Twispay\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;

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
        return [
            'siteId' => $this->getSiteId(),
            'externalOrderId' => $this->getExternalOrderId(),
            'customerId' => $this->getCustomerId(),
        ];
    }

    public function sendData($data)
    {
        try {
            $httpResponse = $this->get($this->endpoint . '?' . http_build_query($this->getData()))->send();

        } catch (ClientErrorResponseException $e) {
            return $this->response = new FetchOrdersResponse($this, $e->getResponse()->json());
        }

        return $this->response = new FetchOrdersResponse($this, $httpResponse->json());
    }

    public function getCustomerId()
    {
        return $this->parameters->get('customerId');
    }

    public function setCustomerId($value)
    {
        return $this->parameters->set('customerId', $value);
    }

    public function getExternalOrderId()
    {
        return $this->parameters->get('externalOrderId');
    }

    public function setExternalOrderId($value)
    {
        return $this->parameters->set('externalOrderId', $value);
    }

}

<?php

namespace Omnipay\Twispay\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;

class GetOrderRequest extends AbstractRequest
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
            'id' => $this->getId(),
        ];
    }

    public function sendData($data)
    {
        try {
            $httpResponse = $this->get($this->endpoint . '/' . $this->getId())->send();
        } catch (ClientErrorResponseException $e) {
            return $this->response = new GetOrderResponse($this, $e->getResponse()->json());
        }

        return $this->response = new GetOrderResponse($this, $httpResponse->json());
    }

    public function getId()
    {
        return $this->getParameter('id');
    }

    public function setId($value)
    {
        return $this->setParameter('id', $value);
    }


}

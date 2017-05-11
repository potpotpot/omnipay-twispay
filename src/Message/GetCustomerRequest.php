<?php

namespace Omnipay\Twispay\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;

/**
 * Class GetCustomerRequest
 * @package Omnipay\Twispay\Message
 */
class GetCustomerRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = '/customer/';

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

    /**
     * @param mixed $data
     *
     * @return GetCustomerResponse
     * @throws \Guzzle\Common\Exception\RuntimeException
     * @throws \Guzzle\Http\Exception\RequestException
     */
    public function sendData($data)
    {
        try {
            $httpResponse = $this->get($this->endpoint . $this->getId())->send();
        } catch (ClientErrorResponseException $e) {
            return $this->response = new GetCustomerResponse($this, $e->getResponse()->json());
        }

        return $this->response = new GetCustomerResponse($this, $httpResponse->json());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getParameter('id');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     * @throws \Omnipay\Common\Exception\RuntimeException
     */
    public function setId($value)
    {
        return $this->setParameter('id', $value);
    }
}

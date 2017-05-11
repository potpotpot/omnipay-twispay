<?php

namespace Omnipay\Twispay\Message;

/**
 * Class CreateCustomerRequest
 * @package Omnipay\Twispay\Message
 */
class CreateCustomerRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = '/customer';

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = [
            'identifier' => $this->getIdentifier(),
            'siteId' => $this->getSiteId(),
            'email' => $this->getEmail(),
        ];

        return $data;
    }

    /**
     * @param array $data
     *
     * @return CreateCustomerResponse
     * @throws \Guzzle\Common\Exception\RuntimeException
     */
    public function sendData($data)
    {
        try {
            $httpResponse = $this->post(
                $this->endpoint,
                null,
                $this->getData(),
                $this->getParameters()
            )->send();
        } catch (\Exception $e) {
            return $this->response = new CreateCustomerResponse($this, $e->getResponse()->json());
        }

        return $this->response = new CreateCustomerResponse($this, $httpResponse->json());
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->parameters->get('identifier');
    }

    /**
     * @param $value
     */
    public function setIdentifier($value)
    {
        return $this->parameters->set('identifier', $value);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->parameters->get('email');
    }

    /**
     * @param $value
     */
    public function setEmail($value)
    {
        return $this->parameters->set('email', $value);
    }
}

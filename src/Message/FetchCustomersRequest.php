<?php

namespace Omnipay\Twispay\Message;

/**
 * Class FetchCustomersRequest
 * @package Omnipay\Twispay\Message
 */
class FetchCustomersRequest extends AbstractRequest
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
     * @param mixed $data
     *
     * @return FetchCustomersResponse
     * @throws \Guzzle\Common\Exception\RuntimeException
     * @throws \Guzzle\Http\Exception\RequestException
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function sendData($data)
    {
        try {
            $httpResponse = $this->get(
                $this->endpoint . '/?' . http_build_query($this->getData()),
                null,
                $this->getData()
            )->send();

        } catch (\Exception $e) {
            return $this->response = new FetchCustomersResponse($this, $e->getResponse()->json());
        }

        return $this->response = new FetchCustomersResponse($this, $httpResponse->json());
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

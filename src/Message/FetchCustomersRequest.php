<?php

namespace Omnipay\Twispay\Message;

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

    public function getIdentifier()
    {
        return $this->parameters->get('identifier');
    }

    public function getEmail()
    {
        return $this->parameters->get('email');
    }

    public function sendData($data)
    {
        $httpResponse = $this->get(
            $this->endpoint . '/?' . http_build_query($this->getData()),
            null,
            $this->getData()
        )->send();

        return $this->response = new FetchCustomersResponse($this, $httpResponse->json());
    }

    public function setIdentifier($value)
    {
        return $this->parameters->set('identifier', $value);
    }

    public function setEmail($value)
    {
        return $this->parameters->set('email', $value);
    }
}

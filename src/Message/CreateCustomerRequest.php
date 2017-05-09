<?php

namespace Omnipay\Twispay\Message;

class CreateCustomerRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = '/customer';

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

    public function setIdentifier($value)
    {
        return $this->parameters->set('identifier', $value);
    }

    public function setEmail($value)
    {
        return $this->parameters->set('email', $value);
    }
}

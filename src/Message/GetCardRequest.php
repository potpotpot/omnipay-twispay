<?php

namespace Omnipay\Twispay\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;

class GetCardRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = '/card';

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        return [
            'id' => $this->getId(),
            'customerId' => $this->getCustomerId(),
        ];
    }

    public function sendData($data)
    {
        try {
            $queryParams = $this->getData();
            unset($queryParams['id']);

//            print_r([__METHOD__ . __LINE__, $this->endpoint . '/' . $this->getId() . '/?' . http_build_query($queryParams)]); exit;

            $httpResponse = $this->get($this->endpoint . '/' . $this->getId() . '/?' . http_build_query($queryParams))->send();
        } catch (ClientErrorResponseException $e) {
            return $this->response = new GetCardResponse($this, $e->getResponse()->json());
        }

        return $this->response = new GetCardResponse($this, $httpResponse->json());
    }

    public function getId()
    {
        return $this->getParameter('id');
    }

    public function setId($value)
    {
        return $this->setParameter('id', $value);
    }

    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $value);
    }

}

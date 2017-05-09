<?php

namespace Omnipay\Twispay\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Omnipay\Twispay\Checksum;

class CreateTransactionRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = '';

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        return [
            'siteId' => $this->getSiteId(),
            'identifier' => $this->getIdentifier(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'orderType' => $this->getOrderType(),
//            'orderId' => $this->getOrderId(),
            'checksum' => $this->getChecksum(),
        ];
    }

    public function sendData($data)
    {
        $postData = $this->getData();
        $postData['checksum'] = Checksum::generate($postData, $this->getApiKey());

        try {
            $httpResponse = $this->post(
                $this->endpoint,
                null,
                $postData,
                $this->getParameters()
            )->send();

        } catch (ClientErrorResponseException $e) {

            return $this->response = new CreateTransactionResponse($this, $e->getResponse()->json());
        }

        return $this->response = new CreateTransactionResponse($this, (string)$httpResponse->getBody());
    }

    public function setIdentifier($value)
    {
        return $this->setParameter('identifier', $value);
    }

    public function getIdentifier()
    {
        return $this->getParameter('identifier');
    }

    public function setOrderType($value)
    {
        return $this->setParameter('orderType', $value);
    }

    public function getOrderType()
    {
        return $this->getParameter('orderType');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function setChecksum($value)
    {
        return $this->setParameter('checksum', $value);
    }

    public function getChecksum()
    {
        return $this->getParameter('checksum');
    }

}

<?php

namespace Omnipay\Twispay\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = '/transaction/';

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
            'orderId' => $this->getOrderId(),
            'checksum' => $this->getChecksum(),
        ];
    }

    public function sendData($data)
    {
        try {
            $httpResponse = $this->post($this->endpoint . $this->getId())->send();
        } catch (ClientErrorResponseException $e) {

            if (stristr($e->getMessage(), 'Not Found') !== false) {
                $code = 404;
                $message = 'Not Found';
            }

            return $this->response = new PurchaseResponse($this, [
                'code' => $code,
                'message' => $message,
            ]);

        }

        return $this->response = new PurchaseResponse($this, $httpResponse->json());
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

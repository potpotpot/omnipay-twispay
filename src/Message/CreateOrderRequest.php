<?php

namespace Omnipay\Twispay\Message;

class CreateOrderRequest extends AbstractRequest
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
        $data = [
            'siteId' => $this->getSiteId(),
            'customerId' => $this->getCustomerId(),
            'ip' => $this->getIp(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'externalOrderId' => $this->getExternalOrderId(),
            'description' => $this->getDescription(),
            'invoiceEmail' => $this->getInvoiceEmail(),
            'orderType' => $this->getOrderType(),
            'cardId' => $this->getCardId(),
            'externalCustomData' => $this->getExternalCustomData(),
//            'transactionMethod' => $this->getTransactionMethod(),
        ];

        return $data;
    }

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
            return $this->response = new CreateOrderResponse($this, $e->getResponse()->json());
        }

        return $this->response = new CreateOrderResponse($this, $httpResponse->json());
    }

    public function getIp()
    {
        return $this->getParameter('ip');
    }

    public function setIp($value)
    {
        return $this->setParameter('ip', $value);
    }

    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $value);
    }

    public function getExternalOrderId()
    {
        return $this->parameters->get('externalOrderId');
    }

    public function setExternalOrderId($value)
    {
        return $this->parameters->set('externalOrderId', $value);
    }

    public function getExternalCustomData()
    {
        return $this->parameters->get('externalCustomData');
    }

    public function setExternalCustomData($value)
    {
        return $this->parameters->set('externalCustomData', $value);
    }

    public function getInvoiceEmail()
    {
        return $this->parameters->get('invoiceEmail');
    }

    public function setInvoiceEmail($value)
    {
        return $this->parameters->set('invoiceEmail', $value);
    }

    public function setOrderType($value)
    {
        return $this->setParameter('orderType', $value);
    }

    public function getOrderType()
    {
        return $this->getParameter('orderType');
    }

    public function getCardId()
    {
        return $this->getParameter('cardId');
    }

    public function setCardId($value)
    {
        return $this->setParameter('cardId', $value);
    }

    public function getTransactionMethod()
    {
        return $this->getParameter('transactionMethod');
    }

    public function setTransactionMethod($value)
    {
        return $this->setParameter('transactionMethod', $value);
    }

}

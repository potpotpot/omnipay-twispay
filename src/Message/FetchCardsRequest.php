<?php

namespace Omnipay\Twispay\Message;

class FetchCardsRequest extends AbstractRequest
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
        $data = [
            'customerId' => $this->getCustomerId(),
            'orderId' => $this->getOrderId(),
            'cardStatus' => $this->getCardStatus(),
        ];

        return $data;
    }

    public function sendData($data)
    {
        try {
            $httpResponse = $this->get(
                $this->endpoint . '/?' . http_build_query($this->getData()),
                null,
                $this->getData()
            )->send();
        } catch (\Exception $e) {
            return $this->response = new FetchCardsResponse($this, $e->getResponse()->json());
        }

        return $this->response = new FetchCardsResponse($this, $httpResponse->json());
    }

    public function getCustomerId()
    {
        return $this->parameters->get('customerId');
    }

    public function setCustomerId($value)
    {
        return $this->parameters->set('customerId', $value);
    }

    public function getCardStatus()
    {
        return $this->parameters->get('cardStatus');
    }

    public function setCardStatus($value)
    {
        return $this->parameters->set('cardStatus', $value);
    }

    public function getOrderId()
    {
        return $this->parameters->get('orderId');
    }

    public function setOrderId($value)
    {
        return $this->parameters->set('orderId', $value);
    }
}

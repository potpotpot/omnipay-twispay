<?php

namespace Omnipay\Twispay\Message;

class FetchTransactionsRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = '/transaction';

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        return [
            'siteId' => $this->getSiteId(),
            'orderId' => $this->getOrderId(),
            'customerId' => $this->getCustomerId(),
            'email' => $this->getEmail(),
            'transactionMethod' => $this->getTransactionMethod(),
            'currency' => $this->getCurrency(),
            'amountFrom' => $this->getAmountFrom(),
            'amountTo' => $this->getAmountTo(),
            'transactionType' => $this->getTransactionType(),
            'transactionStatus' => $this->getTransactionStatus(),
            'createdAtFrom' => $this->getCreatedAtFrom(),
            'createdAtTo' => $this->getCreatedAtTo(),
            'greaterThanId' => '', //Get transactions that have their Id greater than (not including) this value
            'source' => '', // service-call, re-bill, re-bill-micro, card-change
            'ip' => $this->getIp(),
            'fraudScoreGreaterThan' => $this->getFraudScoreGreaterThan(),
            'reason' => 'string',
            'page' => $this->getPage(),
            'perPage' => $this->getPerPage(),
            'reverseSorting' => $this->getReverseSorting(),
            'cardProvider' => $this->getCardProvider(),
            'cardType' => $this->getCardType(),
            'cardNumber' => $this->getCardNumber(),
            'cardHolderName' => $this->getCardHolderName(),
            'country' => $this->getCountry(),
            'state' => $this->getState(),
        ];
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function getTransactionMethod()
    {
        return $this->getParameter('transactionMethod');
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function getAmountFrom()
    {
        return $this->getParameter('amountFrom');
    }

    public function getAmountTo()
    {
        return $this->getParameter('amountTo');
    }

    public function getTransactionType()
    {
        return $this->getParameter('transactionType');
    }

    public function getTransactionStatus()
    {
        return $this->getParameter('transactionStatus');
    }

    public function getCreatedAtFrom()
    {
        return $this->getParameter('createdAtFrom');
    }

    public function getCreatedAtTo()
    {
        return $this->getParameter('createdAtTo');
    }

    public function getIp()
    {
        return $this->getParameter('ip');
    }

    public function getFraudScoreGreaterThan()
    {
        return $this->getParameter('fraudScoreGreaterThan');
    }

    public function getPage()
    {
        return $this->getParameter('page');
    }

    public function getPerPage()
    {
        return $this->getParameter('perPage');
    }

    public function getReverseSorting()
    {
        return $this->getParameter('reverseSorting');
    }

    public function getCardProvider()
    {
        return $this->getParameter('cardProvider');
    }

    public function getCardType()
    {
        return $this->getParameter('cardType');
    }

    public function getCardNumber()
    {
        return $this->getParameter('cardNumber');
    }

    public function getCardHolderName()
    {
        return $this->getParameter('cardHolderName');
    }

    public function getCountry()
    {
        return $this->getParameter('country');
    }

    public function getState()
    {
        return $this->getParameter('state');
    }

    public function sendData($data)
    {
        $httpResponse = $this->get($this->endpoint)->send();

        return $this->response = new FetchTransactionsResponse($this, $httpResponse->json());
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $value);
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function setTransactionMethod($value)
    {
        return $this->setParameter('transactionMethod', $value);
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    public function setAmountFrom($value)
    {
        return $this->setParameter('amountFrom', $value);
    }

    public function setAmountTo($value)
    {
        return $this->setParameter('amountTo', $value);
    }

    public function setTransactionType($value)
    {
        return $this->setParameter('transactionType', $value);
    }

    public function setTransactionStatus($value)
    {
        return $this->setParameter('transactionStatus', $value);
    }

    public function setCreatedAtFrom($value)
    {
        return $this->setParameter('createdAtFrom', $value);
    }

    public function setCreatedAtTo($value)
    {
        return $this->setParameter('createdAtTo', $value);
    }

    public function setGreaterThanId($value)
    {
        return $this->setParameter('greaterThanId', $value);
    }

    public function getGreaterThanId()
    {
        return $this->getParameter('greaterThanId');
    }

    public function setSource($value)
    {
        return $this->setParameter('source', $value);
    }

    public function getSource()
    {
        return $this->getParameter('source');
    }

    public function setIp($value)
    {
        return $this->setParameter('ip', $value);
    }

    public function setFraudScoreGreaterThan($value)
    {
        return $this->setParameter('fraudScoreGreaterThan', $value);
    }

    public function setReason($value)
    {
        return $this->setParameter('reason', $value);
    }

    public function getReason()
    {
        return $this->getParameter('reason');
    }

    public function setPage($value)
    {
        return $this->setParameter('page', $value);
    }

    public function setPerPage($value)
    {
        return $this->setParameter('perPage', $value);
    }

    public function setReverseSorting($value)
    {
        return $this->setParameter('reverseSorting', $value);
    }

    public function setCardProvider($value)
    {
        return $this->setParameter('cardProvider', $value);
    }

    public function setCardType($value)
    {
        return $this->setParameter('cardType', $value);
    }

    public function setCardNumber($value)
    {
        return $this->setParameter('cardNumber', $value);
    }

    public function setCardHolderName($value)
    {
        return $this->setParameter('cardHolderName', $value);
    }

    public function setCountry($value)
    {
        return $this->setParameter('country', $value);
    }

    public function setState($value)
    {
        return $this->setParameter('state', $value);
    }

}

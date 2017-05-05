<?php

namespace Omnipay\Twispay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Twispay\Message\AuthorizeRequest;
use Omnipay\Twispay\Message\FetchOrdersRequest;

/**
 * Twispay Gateway
 *
 * To test different responses based on the 'amount' used
 *
 * 0.02 = Insufficient funds
 * 0.03 = Bank time out
 * 0.04 = Pending at Bank
 * 0.05 = Declined by Bank
 * 0.06 = Rejected by Processor
 * 0.07 = Malformed response from Processor
 * 0.08 = Timeout
 *
 * You can use 4111111111111111 as a card number, any cvv and any exp date in the future.
 *
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $parameters = [])
 * @method \Omnipay\Common\Message\RequestInterface purchase(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = [])
 */
class Gateway extends AbstractGateway
{
    /**
     * @var string
     */
    private $apiKey = '4d4cab364364f3dcb88f9c69c305573a';

    /**
     * @var int
     */
    private $siteId = 73;

    /**
     * @return string
     */
    public function getName()
    {
        return 'Twispay';
    }

    public function fetchOrders(): RequestInterface
    {
        return $this->createRequest(FetchOrdersRequest::class, $this->getDefaultParameters());
    }

    // ------------ Requests ------------ //

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'apiKey' => $this->getApiKey(),
            'siteId' => $this->getSiteId(),
            'testMode' => $this->isTestMode(),
        ];
    }

    // ------------ Getter'n'Setters ------------ //

    /**
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->parameters->get('apiKey', $this->apiKey);
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     *
     * @return string
     */
    public function getSiteId()
    {
        return $this->parameters->get('siteId', $this->siteId);
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSiteId($value)
    {
        return $this->setParameter('siteId', $value);
    }

    /**
     * @return bool
     */
    public function isTestMode()
    {
        // TODO must decide based on environment [andor]
        return true;
    }

    /**
     * @param $name
     * @param $arguments
     */
    function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}

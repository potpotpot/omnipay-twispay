<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Twispay Response
 *
 * This is the response class for all Twispay requests.
 *
 * @see \Omnipay\Twispay\Gateway
 */
class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['success']) && $this->data['success'];
    }

    public function getTransactionReference()
    {
        return isset($this->data['reference']) ? $this->data['reference'] : null;
    }

    public function getMessage()
    {
        return isset($this->data['message']) ? $this->data['message'] : null;
    }
}

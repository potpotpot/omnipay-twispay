<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractResponse;

class CreateCustomerResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return
            isset($this->data['code'])
            && $this->data['code'] == 201;
    }

    public function getMessage()
    {
        return $this->data['message'];
    }

    public function getCode()
    {
        return $this->data['code'];

    }

    public function getErrors()
    {
        return $this->data['error'];
    }

    public function getCustomerId()
    {
        if ($this->isSuccessful()) {
            return $this->data['data']['id'];
        }

        return null;
    }
}

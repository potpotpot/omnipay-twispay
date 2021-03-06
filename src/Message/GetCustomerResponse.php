<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractResponse;

class GetCustomerResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return
            isset($this->data['code'])
            && $this->data['code'] == 200;
    }

    public function getMessage()
    {
        return $this->data['message'];
    }

    public function getCode()
    {
        return $this->data['code'];
    }

    public function getCustomerData()
    {
        return $this->data['data'];
    }

    public function getCustomerId()
    {
        return $this->data['data']['id'];
    }

    public function getErrors()
    {
        return $this->data['error'];
    }

}

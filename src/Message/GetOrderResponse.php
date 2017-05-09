<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractResponse;

class GetOrderResponse extends AbstractResponse
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

    public function getErrors()
    {
        return $this->data['error'];
    }

    public function getOrderData()
    {
        return $this->data['data'];
    }

    public function getOrderId()
    {
        return $this->data['data']['id'];
    }

}

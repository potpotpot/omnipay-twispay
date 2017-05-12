<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractResponse;


class FetchCustomersResponse extends AbstractResponse
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

    public function getTotalItemCount()
    {
        return $this->data['pagination']['totalItemCount'];
    }

    public function getErrors()
    {
        return $this->data['error'];
    }

    public function getCustomerData()
    {
        return $this->data['data'];
    }
}

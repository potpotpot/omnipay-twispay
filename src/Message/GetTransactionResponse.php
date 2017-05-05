<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractResponse;


class GetTransactionResponse extends AbstractResponse
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
}

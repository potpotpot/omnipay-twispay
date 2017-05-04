<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

abstract class AbstractRequest extends CommonAbstractRequest
{
    /**
     * Get live- or testURL.
     */
    public function getUrl()
    {
        if ($this->getTestMode()) {
            return 'https://api-stage.twispay.com';
        } else {
            return 'https://https://api.twispay.com';
        }
    }
}

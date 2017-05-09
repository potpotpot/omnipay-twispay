<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Tests\TestCase;

class FetchOrdersRequestTest extends TestCase
{
    /**
     * @var FetchOrdersRequest
     */
    protected $request;

    public function setUp()
    {
        $this->request = new FetchOrdersRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame([
            'siteId' => null,
            'externalOrderId' => null,
            'customerId' => null,
        ], $data);
    }
}

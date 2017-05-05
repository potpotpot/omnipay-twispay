<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Tests\TestCase;

class GetTransactionRequestTest extends TestCase
{
    /**
     * @var RequestInterface
     */
    protected $request;

    public function setUp()
    {
        $this->request = new GetTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'id' => 11,
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame(['id' => 11,], $data);
    }
}

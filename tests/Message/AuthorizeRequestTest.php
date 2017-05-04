<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    /**
     * @var RequestInterface
     */
    protected $request;

    public function setUp()
    {
        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('10.00', $data['amount']);
    }
}

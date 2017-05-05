<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Tests\TestCase;

class FetchTransactionsRequestTest extends TestCase
{
    /**
     * @var RequestInterface
     */
    protected $request;

    public function setUp()
    {
        $this->request = new FetchTransactionsRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize($this->composeBasicTestData());
    }

    protected function composeBasicTestData()
    {
        return [
            'siteId' => 73,
            'orderId' => null,
            'customerId' => null,
            'email' => 'xxxxxxxxxxx',
            'transactionMethod' => 'card',
            'currency' => 'EUR',
            'amountFrom' => 'string',
            'amountTo' => 'string',
            'transactionType' => 'deposit',
            'transactionStatus' => 'start',
            'createdAtFrom' => '',
            'createdAtTo' => '',
            'greaterThanId' => '', //Get transactions that have their Id greater than (not including) this value
            'source' => '', // service-call, re-bill, re-bill-micro, card-change
            'ip' => 'string',
            'fraudScoreGreaterThan' => 0,
            'reason' => 'string',
            'page' => 1,
            'perPage' => 101,
            'reverseSorting' => 1,
            'cardProvider' => 'string',
            'cardType' => 'string',
            'cardNumber' => 'string',
            'cardHolderName' => 'string',
            'country' => 'string',
            'state' => 'string',
        ];
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame($this->composeBasicTestData(), $data);
    }
}

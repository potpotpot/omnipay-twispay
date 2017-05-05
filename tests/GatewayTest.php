<?php

namespace Omnipay\Twispay;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\Twispay\Message\FetchOrdersResponse;
use Omnipay\Twispay\Message\FetchTransactionsResponse;

/**
 * Class GatewayTest
 * @package Omnipay\Twispay
 */
class GatewayTest extends GatewayTestCase
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \PHPUnit_Framework_Exception
     */
    public function testFetchOrdersSuccess()
    {
        $response = $this->gateway->fetchOrders()->send();

        $this->assertInstanceOf(FetchOrdersResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());
    }

    /**
     * @expectedException \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function testFetchOrdersFailure()
    {
        // Set an invalid api key
        $this->gateway->setApiKey('XXXXXX');
        $this->gateway->fetchOrders()->send();
    }


    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \PHPUnit_Framework_Exception
     */
    public function testFetchTransactionsSuccess()
    {
        $response = $this->gateway->fetchTransactions()->send();

        $this->assertInstanceOf(FetchTransactionsResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());
    }

    /**
     * @expectedException \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function testFetchTransactionsFailure()
    {
        // Set an invalid api key
        $this->gateway->setApiKey('XXXXXX');
        $this->gateway->fetchTransactions()->send();
    }


    //    /**
    //     * @throws \PHPUnit_Framework_AssertionFailedError
    //     * @throws \PHPUnit_Framework_Exception
    //     */
    //    public function testPurchaseSuccess()
    //    {
    //        // card numbers ending in even number should be successful
    //        $this->options['card']['number'] = '4242424242424242';
    //        $response = $this->gateway->purchase($this->options)->send();
    //
    //        $this->assertInstanceOf('\Omnipay\Twispay\Message\Response', $response);
    //        $this->assertTrue($response->isSuccessful());
    //        $this->assertFalse($response->isRedirect());
    //        $this->assertNotEmpty($response->getTransactionReference());
    //        $this->assertSame('Success', $response->getMessage());
    //    }
    //
    //    /**
    //     * @throws \PHPUnit_Framework_AssertionFailedError
    //     * @throws \PHPUnit_Framework_Exception
    //     */
    //    public function testPurcahseFailure()
    //    {
    //        // card numbers ending in odd number should be declined
    //        $this->options['card']['number'] = '4111111111111111';
    //        $response = $this->gateway->purchase($this->options)->send();
    //
    //        $this->assertInstanceOf('\Omnipay\Twispay\Message\Response', $response);
    //        $this->assertFalse($response->isSuccessful());
    //        $this->assertFalse($response->isRedirect());
    //        $this->assertNotEmpty($response->getTransactionReference());
    //        $this->assertSame('Failure', $response->getMessage());
    //    }
}

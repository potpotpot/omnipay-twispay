<?php

namespace Omnipay\Twispay;

use Omnipay\Tests\GatewayTestCase;

/**
 * Class GatewayTest
 * @package Omnipay\Twispay
 */
class GatewayTest extends GatewayTestCase
{
    /**
     *
     */
    public function setUp()
    {
        parent::setUp();


        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        /**
         * @var array
         */
        $this->options = [
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ];
    }

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \PHPUnit_Framework_Exception
     */
    public function testAuthorizeSuccess()
    {
        // card numbers ending in even number should be successful
        $this->options['card']['number'] = '4242424242424242';
        $response = $this->gateway->authorize($this->options)->send();

        $this->assertInstanceOf('\Omnipay\Twispay\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotEmpty($response->getTransactionReference());
        $this->assertSame('Success', $response->getMessage());
    }

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \PHPUnit_Framework_Exception
     */
    public function testAuthorizeFailure()
    {
        // card numbers ending in odd number should be declined
        $this->options['card']['number'] = '4111111111111111';
        $response = $this->gateway->authorize($this->options)->send();

        $this->assertInstanceOf('\Omnipay\Twispay\Message\Response', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotEmpty($response->getTransactionReference());
        $this->assertSame('Failure', $response->getMessage());
    }

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \PHPUnit_Framework_Exception
     */
    public function testPurchaseSuccess()
    {
        // card numbers ending in even number should be successful
        $this->options['card']['number'] = '4242424242424242';
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertInstanceOf('\Omnipay\Twispay\Message\Response', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotEmpty($response->getTransactionReference());
        $this->assertSame('Success', $response->getMessage());
    }

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \PHPUnit_Framework_Exception
     */
    public function testPurcahseFailure()
    {
        // card numbers ending in odd number should be declined
        $this->options['card']['number'] = '4111111111111111';
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertInstanceOf('\Omnipay\Twispay\Message\Response', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotEmpty($response->getTransactionReference());
        $this->assertSame('Failure', $response->getMessage());
    }
}

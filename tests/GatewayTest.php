<?php

namespace Omnipay\Twispay;

use Guzzle\Http\Exception\ClientErrorResponseException;
use Omnipay\Tests\GatewayTestCase;

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
    public function testAuthorizeSuccess()
    {
        // card numbers ending in even number should be successful
        $this->options = [
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ];
        $this->options['card']['number'] = '4242424242424242';
        $response = $this->gateway->authorize($this->options)->send();

        $this->assertInstanceOf('\Omnipay\Twispay\Message\AuthorizeResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());
    }

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \PHPUnit_Framework_Exception
     */
    public function testAuthorizeFailure()
    {
        // card numbers ending in odd number should be declined
        $this->options = [
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ];
        $this->options['card']['number'] = '4111111111111111';
        $response = $this->gateway->authorize($this->options)->send();

        $this->assertInstanceOf('\Omnipay\Twispay\Message\AuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Failure', $response->getMessage());
    }

    public function testAuthorizeParameters()
    {
        if ($this->gateway->supportsAuthorize()) {
            foreach ($this->gateway->getDefaultParameters() as $key => $default) {
                // set property on gateway
                $getter = 'get' . ucfirst($this->camelCase($key));
                $setter = 'set' . ucfirst($this->camelCase($key));
                $value = uniqid();
                $this->gateway->$setter($value);

                // request should have matching property, with correct value
                $request = $this->gateway->authorize();
                $this->assertSame($value, $this->gateway->$getter());
            }
        }
    }

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \PHPUnit_Framework_Exception
     */
    public function testFetchOrdersSuccess()
    {
        $response = $this->gateway->fetchOrders()->send();

        $this->assertInstanceOf('\Omnipay\Twispay\Message\FetchOrdersResponse', $response);
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

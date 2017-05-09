<?php

namespace Omnipay\Twispay;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Twispay\Message\CreateCustomerResponse;
use Omnipay\Twispay\Message\FetchCustomersResponse;
use Omnipay\Twispay\Message\FetchOrdersResponse;
use Omnipay\Twispay\Message\FetchTransactionsResponse;
use Omnipay\Twispay\Message\GetCustomerResponse;
use Omnipay\Twispay\Message\GetTransactionResponse;

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

    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     * @throws \PHPUnit_Framework_Exception
     */
    public function testFetchCustomersSuccess()
    {
        $filters = [
            'identifier' => 'tittelandor',
            'email' => 'andor.tittel@proemergotech.com',
        ];
//        $filters = [];
        $response = $this->gateway->fetchCustomers($filters)->send();

        $this->assertInstanceOf(FetchCustomersResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());

//        print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
    }

    /**
     * @expectedException \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function testFetchCustomersFailure()
    {
        // Set an invalid api key
        $this->gateway->setApiKey('XXXXXX');
        $this->gateway->fetchCustomers()->send();
    }

    public function testCreateCustomerSuccess()
    {
        $rand = 'test-' . rand(10000, PHP_INT_MAX/4);
        $customerData = [
            'identifier' => $rand,
            'email' => $rand  .'@proemergotech.com',
        ];
        $response = $this->gateway->createCustomer($customerData)->send();

        $this->assertInstanceOf(CreateCustomerResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Created', $response->getMessage());
        $this->assertNotEmpty($response->getCustomerId());

//        print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
    }

    public function testCreateCustomerFailureMissingMandatoryFields()
    {
        $customerData = [];
        $response = $this->gateway->createCustomer($customerData)->send();

        $this->assertInstanceOf(CreateCustomerResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Bad Request', $response->getMessage());
        $this->assertSame(400, $response->getCode());
        $this->assertNotEmpty($response->getErrors());
        foreach ($response->getErrors() as $error) {
            $this->assertTrue(in_array($error['code'], [1620, 1646]));
        }
//        print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
    }

    public function testGetCustomerFailure()
    {
        // Set an invalid api key
        $response = $this->gateway->getCustomer(rand(1, 10))->send();
        $this->assertInstanceOf(GetCustomerResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());

        $this->assertSame('Not Found', $response->getMessage());
        $this->assertSame(404, $response->getCode());
    }

    public function testGetCustomerSuccess()
    {
        /** @var GetTransactionResponse $response */
        $response = $this->gateway->getCustomer(3719)->send();
        $this->assertInstanceOf(GetCustomerResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());

        $this->assertNotEmpty($response->getCustomerData());
        $this->assertEquals(3719, $response->getCustomerId());
//        print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
    }



    public function testGetTransactionFailure()
    {
        // Set an invalid api key
        $response = $this->gateway->getTransaction(rand(1, 10))->send();
        $this->assertInstanceOf(GetTransactionResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());

        $this->assertSame('Not Found', $response->getMessage());
        $this->assertSame(404, $response->getCode());
    }

    public function testFetchTransactionSuccess()
    {
        /** @var GetTransactionResponse $response */
        $response = $this->gateway->getTransaction(16177)->send();
        $this->assertInstanceOf(GetTransactionResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());

        $this->assertTrue(is_array($response->getTransactionData()));
        $this->assertEquals(16177, $response->getTransactionId());
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

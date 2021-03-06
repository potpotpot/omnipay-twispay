<?php

namespace Omnipay\Twispay;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Twispay\Message\CreateCustomerResponse;
use Omnipay\Twispay\Message\CreateOrderResponse;
use Omnipay\Twispay\Message\CreateTransactionResponse;
use Omnipay\Twispay\Message\FetchCardsResponse;
use Omnipay\Twispay\Message\FetchCustomersResponse;
use Omnipay\Twispay\Message\FetchOrdersResponse;
use Omnipay\Twispay\Message\FetchTransactionsResponse;
use Omnipay\Twispay\Message\GetCardResponse;
use Omnipay\Twispay\Message\GetCustomerResponse;
use Omnipay\Twispay\Message\GetOrderResponse;
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

        $key = file_get_contents(__DIR__ . '/../.api_key');
        $this->gateway->setApiKey(trim($key));
    }

    public function testCreateOrderSuccess()
    {
        $orderData = [
            'customerId' => 3719,
            'ip' => 'fe80::b9b9:f09a:265e:d976',
            'amount' => 0.01,
            'currency' => 'EUR',
            'orderType' => 'purchase',

            'externalOrderId' => 'test-' . rand(10000, PHP_INT_MAX / 922222),
        ];
        $response = $this->gateway->createOrder($orderData)->send();

        $this->assertInstanceOf(CreateOrderResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Created', $response->getMessage());
        $this->assertNotEmpty($response->getOrderId());
        //        print_r([__METHOD__ . __LINE__, $response->getData()]);exit;
    }

    public function testFetchOrdersSuccess()
    {
        $parameters = [
            'siteId' => [73],
            //            'externalOrderId' => 'sssss',
            //            'customerId' => 3719,
        ];
        $response = $this->gateway->fetchOrders($parameters)->send();

        $this->assertInstanceOf(FetchOrdersResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());
        $this->assertNotEmpty($response->getData());
        //        print_r([__METHOD__ . __LINE__, $response->getData()]);exit;
    }

    public function testFetchOrdersFailure()
    {
        // Set an invalid api key
        $this->gateway->setApiKey('XXXXXX');
        $this->gateway->fetchOrders()->send();
    }

    public function testGetOrderNotFound()
    {
        $response = $this->gateway->getOrder(rand(PHP_INT_MAX / 2, PHP_INT_MAX))->send();

        $this->assertInstanceOf(GetOrderResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());

        $this->assertSame('Not Found', $response->getMessage());
        $this->assertEquals(404, $response->getCode());
        //        print_r([__METHOD__ . __LINE__, $response->getErrors()]); exit;
    }

    public function testGetOrderSuccess()
    {
        $response = $this->gateway->getOrder(10075)->send();

        $this->assertInstanceOf(GetOrderResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());

        $this->assertNotEmpty($response->getOrderData());
        $this->assertEquals(10075, $response->getOrderId());
        //        print_r([__METHOD__ . __LINE__, $response->getOrderData()]); exit;
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
        //        print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
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
            //            'identifier' => 'tittelandor',
            'email' => 'andor.tittel@proemergotech.com',
        ];
        //        $filters = [];
        $response = $this->gateway->fetchCustomers($filters)->send();

        $this->assertInstanceOf(FetchCustomersResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());

        //                print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
    }

    public function testFetchCustomersFailure()
    {
        // Set an invalid api key
        $this->gateway->setApiKey('XXXXXX');
        $response = $this->gateway->fetchCustomers()->send();

        $this->assertInstanceOf(FetchCustomersResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Unauthorized', $response->getMessage());
        $this->assertEquals('401', $response->getCode());

//        print_r([__METHOD__ . __LINE__, $response->getData()]);exit;
    }

    public function testCreateCustomerSuccess()
    {
        $rand = '_33deaffe-da9d-9a33-93ab-' . rand(1000,9999);
        $customerData = [
            'identifier' => $rand,
            'email' => $rand . '@proemergotech.com',
        ];
        $response = $this->gateway->createCustomer($customerData)->send();

//        print_r([__METHOD__ . __LINE__, $response->getData(), $response->getCustomerId()]);

        $this->assertInstanceOf(CreateCustomerResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Created', $response->getMessage());
        $this->assertNotEmpty($response->getCustomerId());
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

    public function testGetCustomerFailureNotFound()
    {
        $response = $this->gateway->getCustomer(rand(1, 10))->send();
        $this->assertInstanceOf(GetCustomerResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());

        $this->assertSame('Not Found', $response->getMessage());
        $this->assertSame(404, $response->getCode());

//        print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
    }

    public function testGetCustomerFailureInvalid()
    {
        $response = $this->gateway->getCustomer(0)->send();
//        print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
        $this->assertInstanceOf(GetCustomerResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());

        $this->assertSame('Bad Request', $response->getMessage());
        $this->assertSame(400, $response->getCode());
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

    public function testFetchCardsSuccess()
    {
        $filters = [
            'customerId' => 3719,
        ];
        $response = $this->gateway->fetchCards($filters)->send();
        $this->assertInstanceOf(FetchCardsResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());
        //        print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
    }

    public function testFetchCardsFailureEmptyFilters()
    {
        $filters = [];
        $response = $this->gateway->fetchCards($filters)->send();
        $this->assertInstanceOf(FetchCardsResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Bad Request', $response->getMessage());
        $this->assertSame(1620, $response->getErrors()[0]['code']);

        //        print_r([__METHOD__ . __LINE__, $response->getData()]); exit;
    }

    public function testGetCardFailure()
    {
        $response = $this->gateway->getCard([
            'id' => rand(1, 10),
        ])->send();

        $this->assertInstanceOf(GetCardResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());

        $this->assertSame('Bad Request', $response->getMessage());
        $this->assertEquals(400, $response->getCode());
        $this->assertEquals(1620, $response->getErrors()[0]['code']);
        //        print_r([__METHOD__ . __LINE__, $response->getErrors()]); exit;
    }

    public function testGetCardSuccess()
    {
        $response = $this->gateway->getCard([
            'id' => 7744,
            'customerId' => 3719,
        ])->send();

        $this->assertInstanceOf(GetCardResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());

        $this->assertNotEmpty($response->getCardData());
        $this->assertEquals(3719, $response->getCustomerId());
        $this->assertEquals(7744, $response->getCardId());
        //        print_r([__METHOD__ . __LINE__, $response->getCardData()]); exit;
    }

    public function testPurchaseSuccess()
    {
        // card numbers ending in even number should be successful
        $parameters = [
            'siteId' => 73,
            'identifier' => 'tittelandor',
            'amount' => 0.01,
            'currency' => 'EUR',
            'description' => 'test-trans',
            'orderType' => 'purchase',
            'orderId' => 11282,

        ];
        $response = $this->gateway->purchase($parameters)->send();

        //        print_r([__METHOD__ . __LINE__, $response->getData()]);exit;

        $this->assertInstanceOf(CreateTransactionResponse::class, $response);
        //        $this->assertTrue($response->isSuccessful());
        //        $this->assertFalse($response->isRedirect());
        //        $this->assertNotEmpty($response->getTransactionReference());
        //        $this->assertSame('Success', $response->getMessage());
    }

    public function testPurchaseParameters()
    {
        //
    }

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

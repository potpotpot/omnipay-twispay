<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Tests\TestCase;

class FetchOrdersResponseTest extends TestCase
{
    public function testSuccess()
    {
        $response = new FetchOrdersResponse(
            $this->getMockRequest(),
            ['code' => 200, 'message' => 'Success']
        );

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());
    }

    public function testFailure()
    {
        $response = new FetchOrdersResponse(
            $this->getMockRequest(),
            ['success' => 0, 'message' => 'Failure']
        );

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Failure', $response->getMessage());
    }
}

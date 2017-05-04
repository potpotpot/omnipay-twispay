<?php

namespace Omnipay\Twispay\Message;

use Omnipay\Tests\TestCase;

class AuthorizeResponseTest extends TestCase
{
    public function testSuccess()
    {
        $response = new AuthorizeResponse(
            $this->getMockRequest(),
            ['success' => 1, 'message' => 'Success']
        );

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());
    }

    public function testFailure()
    {
        $response = new AuthorizeResponse(
            $this->getMockRequest(),
            ['success' => 0, 'message' => 'Failure']
        );

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Failure', $response->getMessage());
    }
}

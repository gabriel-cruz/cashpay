<?php

namespace Mocks;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class MockTest extends TestCase
{
    public function testAuthorizeTransaction(){
        $client = new Client();
        $response = $client->get('https://run.mocky.io/v3/5794d450-d2e2-4412-8131-73d0293ac1cc')->getStatusCode();

        $this->assertEquals(200, $response);
    }

    public function testNotifyUser(){
        $client = new Client();
        $response = $client->get('https://run.mocky.io/v3/54dc2cf1-3add-45b5-b5a9-6bf7e7f1f4a6')->getStatusCode();

        $this->assertEquals(200, $response);
    }
}

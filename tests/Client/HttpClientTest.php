<?php

namespace FinBlocks\Tests\Client;

use FinBlocks\Client\HttpClient;
use FinBlocks\Client\HttpResponse;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class HttpClientTest extends TestCase
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->httpClient = new HttpClient('key', 'cert', 'info', true);
    }

    public function testHttpGetRequest()
    {
        $httpResponse = $this->httpClient->get('/', []);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
    }

    public function testHttpPostRequest()
    {
        $httpResponse = $this->httpClient->post('/', []);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
    }

    public function testHttpPutRequest()
    {
        $httpResponse = $this->httpClient->put('/', []);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
    }

    public function testHttpPatchRequest()
    {
        $httpResponse = $this->httpClient->patch('/', []);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
    }

    public function testHttpDeleteRequest()
    {
        $httpResponse = $this->httpClient->delete('/', []);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
    }
}

<?php

namespace Finblocks\Tests\IntegrationTesting\Client;

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
        $this->httpClient = new HttpClient('', '', '', true);
    }

    public function testHttpGetRequest()
    {
        $httpResponse = $this->httpClient->get('/', []);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
        $this->assertEquals(401, $httpResponse->getStatusCode());
    }

    public function testHttpPostRequest()
    {
        $httpResponse = $this->httpClient->post('/', ['parameter' => 'content']);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
        $this->assertEquals(401, $httpResponse->getStatusCode());
    }

    public function testHttpPutRequest()
    {
        $httpResponse = $this->httpClient->put('/', []);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
        $this->assertEquals(401, $httpResponse->getStatusCode());
    }

    public function testHttpPatchRequest()
    {
        $httpResponse = $this->httpClient->patch('/', []);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
        $this->assertEquals(401, $httpResponse->getStatusCode());
    }

    public function testHttpDeleteRequest()
    {
        $httpResponse = $this->httpClient->delete('/', []);

        $this->assertInstanceOf(HttpResponse::class, $httpResponse);
        $this->assertEquals(401, $httpResponse->getStatusCode());
    }
}

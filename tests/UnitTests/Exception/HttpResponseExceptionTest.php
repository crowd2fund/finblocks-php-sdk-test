<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\UnitTests\Exception;

use FinBlocks\Client\HttpResponse;
use FinBlocks\Exception\HttpClientException;
use FinBlocks\Exception\HttpServerException;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class HttpResponseExceptionTest extends TestCase
{
    public function testBadRequestHttpClientException()
    {
        $httpException = HttpClientException::badRequest(new HttpResponse(HttpResponse::BAD_REQUEST, '{}'));

        $this->assertInstanceOf(HttpClientException::class, $httpException);
        $this->assertInstanceOf(HttpResponse::class, $httpException->getResponse());
        $this->assertEquals(HttpResponse::BAD_REQUEST, $httpException->getCode());
        $this->assertEquals(HttpResponse::BAD_REQUEST, $httpException->getResponseCode());
        $this->assertEquals('{}', $httpException->getResponseBody());
    }

    public function testUnauthorisedHttpClientException()
    {
        $httpException = HttpClientException::unauthorized(new HttpResponse(HttpResponse::UNAUTHORIZED, '{}'));

        $this->assertInstanceOf(HttpClientException::class, $httpException);
        $this->assertInstanceOf(HttpResponse::class, $httpException->getResponse());
        $this->assertEquals(HttpResponse::UNAUTHORIZED, $httpException->getCode());
        $this->assertEquals(HttpResponse::UNAUTHORIZED, $httpException->getResponseCode());
        $this->assertEquals('{}', $httpException->getResponseBody());
    }

    public function testForbiddenHttpClientException()
    {
        $httpException = HttpClientException::forbidden(new HttpResponse(HttpResponse::FORBIDDEN, '{}'));

        $this->assertInstanceOf(HttpClientException::class, $httpException);
        $this->assertInstanceOf(HttpResponse::class, $httpException->getResponse());
        $this->assertEquals(HttpResponse::FORBIDDEN, $httpException->getCode());
        $this->assertEquals(HttpResponse::FORBIDDEN, $httpException->getResponseCode());
        $this->assertEquals('{}', $httpException->getResponseBody());
    }

    public function testNotFoundHttpClientException()
    {
        $httpException = HttpClientException::notFound(new HttpResponse(HttpResponse::NOT_FOUND, '{}'));

        $this->assertInstanceOf(HttpClientException::class, $httpException);
        $this->assertInstanceOf(HttpResponse::class, $httpException->getResponse());
        $this->assertEquals(HttpResponse::NOT_FOUND, $httpException->getCode());
        $this->assertEquals(HttpResponse::NOT_FOUND, $httpException->getResponseCode());
        $this->assertEquals('{}', $httpException->getResponseBody());
    }

    public function testPayloadTooLargeHttpClientException()
    {
        $httpException = HttpClientException::payloadTooLarge(new HttpResponse(HttpResponse::PAYLOAD_TOO_LARGE, '{}'));

        $this->assertInstanceOf(HttpClientException::class, $httpException);
        $this->assertInstanceOf(HttpResponse::class, $httpException->getResponse());
        $this->assertEquals(HttpResponse::PAYLOAD_TOO_LARGE, $httpException->getCode());
        $this->assertEquals(HttpResponse::PAYLOAD_TOO_LARGE, $httpException->getResponseCode());
        $this->assertEquals('{}', $httpException->getResponseBody());
    }

    public function testTooManyRequestsHttpClientException()
    {
        $httpException = HttpClientException::tooManyRequests(new HttpResponse(HttpResponse::TOO_MANY_REQUESTS, '{}'));

        $this->assertInstanceOf(HttpClientException::class, $httpException);
        $this->assertInstanceOf(HttpResponse::class, $httpException->getResponse());
        $this->assertEquals(HttpResponse::TOO_MANY_REQUESTS, $httpException->getCode());
        $this->assertEquals(HttpResponse::TOO_MANY_REQUESTS, $httpException->getResponseCode());
        $this->assertEquals('{}', $httpException->getResponseBody());
    }

    public function testInternalServerErrorHttpClientException()
    {
        $httpException = HttpServerException::internalServerError(new HttpResponse(HttpResponse::INTERNAL_SERVER_ERROR, '{}'));

        $this->assertInstanceOf(HttpServerException::class, $httpException);
        $this->assertInstanceOf(HttpResponse::class, $httpException->getResponse());
        $this->assertEquals(HttpResponse::INTERNAL_SERVER_ERROR, $httpException->getCode());
        $this->assertEquals(HttpResponse::INTERNAL_SERVER_ERROR, $httpException->getResponseCode());
        $this->assertEquals('{}', $httpException->getResponseBody());
    }

    public function testServiceUnavailableHttpClientException()
    {
        $httpException = HttpServerException::serviceUnavailableError(new HttpResponse(HttpResponse::SERVICE_UNAVAILABLE, '{}'));

        $this->assertInstanceOf(HttpServerException::class, $httpException);
        $this->assertInstanceOf(HttpResponse::class, $httpException->getResponse());
        $this->assertEquals(HttpResponse::SERVICE_UNAVAILABLE, $httpException->getCode());
        $this->assertEquals(HttpResponse::SERVICE_UNAVAILABLE, $httpException->getResponseCode());
        $this->assertEquals('{}', $httpException->getResponseBody());
    }
}

<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\API;

use FinBlocks\Client\HttpClient;
use FinBlocks\Client\HttpResponse;
use FinBlocks\Exception\AbstractHttpException;
use FinBlocks\Exception\HttpClientException;
use FinBlocks\Exception\HttpServerException;
use FinBlocks\Exception\SerializerException;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
abstract class AbstractHttpApi
{
    /**
     * The HTTP client.
     *
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param HttpResponse $httpResponse
     * @param string|null  $class
     *
     * @throws HttpClientException
     * @throws HttpServerException
     * @throws SerializerException
     *
     * @return mixed
     */
    protected function hydrateResponse(HttpResponse $httpResponse, string $class = null)
    {
        if (!$httpResponse->wasSuccessful()) {
            $this->handleErrors($httpResponse);
        }

        if (HttpResponse::NO_CONTENT === $httpResponse->getStatusCode()) {
            return null;
        }

        try {
            Assert::stringNotEmpty($class);
            Assert::classExists($class);
            Assert::methodExists($class, 'createFromPayload');

            return $class::createFromPayload($httpResponse->getBody());
        } catch (\Throwable $throwable) {
            throw new SerializerException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Throw the correct exception for this error.
     *
     * @param HttpResponse $response
     *
     * @throws AbstractHttpException
     */
    private function handleErrors(HttpResponse $response)
    {
        switch ($response->getStatusCode()) {
            case HttpResponse::BAD_REQUEST:
                throw HttpClientException::badRequest($response);
            case HttpResponse::UNAUTHORIZED:
                throw HttpClientException::unauthorized($response);
            case HttpResponse::FORBIDDEN:
                throw HttpClientException::forbidden($response);
            case HttpResponse::NOT_FOUND:
                throw HttpClientException::notFound($response);
            case HttpResponse::PAYLOAD_TOO_LARGE:
                throw HttpClientException::payloadTooLarge($response);
            case HttpResponse::TOO_MANY_REQUESTS:
                throw HttpClientException::tooManyRequests($response);
            case HttpResponse::SERVICE_UNAVAILABLE:
                throw HttpServerException::serviceUnavailableError($response);
            case HttpResponse::INTERNAL_SERVER_ERROR: default:
                throw HttpServerException::internalServerError($response);
        }
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path       Request path
     * @param array  $parameters GET parameters
     *
     * @return HttpResponse
     */
    protected function httpGet($path, array $parameters = [])
    {
        return $this->httpClient->get($path, $parameters);
    }

    /**
     * Send a POST request with parameters.
     *
     * @param string $path       Request path
     * @param array  $parameters POST parameters
     *
     * @return HttpResponse
     */
    protected function httpPost($path, array $parameters = [])
    {
        return $this->httpClient->post($path, $parameters);
    }

    /**
     * Send a PUT request.
     *
     * @param string $path       Request path
     * @param array  $parameters PUT parameters
     *
     * @return HttpResponse
     */
    protected function httpPut($path, array $parameters = [])
    {
        return $this->httpClient->put($path, $parameters);
    }

    /**
     * Send a PUT request.
     *
     * @param string $path       Request path
     * @param array  $parameters PUT parameters
     *
     * @return HttpResponse
     */
    protected function httpPatch($path, array $parameters = [])
    {
        return $this->httpClient->patch($path, $parameters);
    }

    /**
     * Send a DELETE request.
     *
     * @param string $path       Request path
     * @param array  $parameters DELETE parameters
     *
     * @return HttpResponse
     */
    protected function httpDelete($path, array $parameters = [])
    {
        return $this->httpClient->delete($path, $parameters);
    }
}

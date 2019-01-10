<?php

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
            case 400:
                throw HttpClientException::badRequest($response);
            case 401:
                throw HttpClientException::unauthorized($response);
            case 403:
                throw HttpClientException::forbidden($response);
            case 404:
                throw HttpClientException::notFound($response);
            case 413:
                throw HttpClientException::payloadTooLarge($response);
            case 429:
                throw HttpClientException::tooManyRequests($response);
            case 503:
                throw HttpServerException::serviceUnavailableError($response);
            case 500: default:
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

<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Client;

use FinBlocks\Exception\HttpRequestException;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class HttpClient
{
    /**
     * @var string
     */
    private $pathToKey;

    /**
     * @var string
     */
    private $pathToCert;

    /**
     * @var string
     */
    private $pathToInfo;

    /**
     * @var string
     */
    private $server;

    /**
     * HttpClient constructor.
     *
     * @param string      $key     Path to the SSL Certificate Key file
     * @param string      $cert    Path to the SSL Certificate file
     * @param string      $info    Path to the CA Certificate file
     * @param bool        $sandbox Use SANDBOX environment
     * @param string|null $server  Use this parameter to override the FinBlocks Server that the SDK will target
     */
    public function __construct(string $key, string $cert, string $info, bool $sandbox = false, string $server = null)
    {
        $this->pathToKey = $key;
        $this->pathToCert = $cert;
        $this->pathToInfo = $info;

        $this->server = sprintf('https://api.%sfinblocks.net', ($sandbox ? 'sandbox.' : ''));

        if (!empty($server)) {
            //$this->server = 'https://api.test.fb.mph.im';
            //$this->server = 'https://api.staging.finblocks.net';
            $this->server = $server;
        }
    }

    /**
     * Send a GET request to the given API endpoint.
     *
     * @param string $apiEndpoint
     * @param array  $parameters
     *
     * @return HttpResponse
     */
    public function get(string $apiEndpoint, array $parameters = []): HttpResponse
    {
        return $this->httpRequest('GET', $apiEndpoint, $parameters);
    }

    /**
     * Send a POST request to the given API endpoint.
     *
     * @param string $apiEndpoint
     * @param array  $parameters
     *
     * @return HttpResponse
     */
    public function post(string $apiEndpoint, array $parameters = []): HttpResponse
    {
        return $this->httpRequest('POST', $apiEndpoint, $parameters);
    }

    /**
     * Send a PUT request to the given API endpoint.
     *
     * @param string $apiEndpoint
     * @param array  $parameters
     *
     * @return HttpResponse
     */
    public function put(string $apiEndpoint, array $parameters = []): HttpResponse
    {
        return $this->httpRequest('PUT', $apiEndpoint, $parameters);
    }

    /**
     * Send a DELETE request to the given API endpoint.
     *
     * @param string $apiEndpoint
     * @param array  $parameters
     *
     * @return HttpResponse
     */
    public function delete(string $apiEndpoint, array $parameters = []): HttpResponse
    {
        return $this->httpRequest('DELETE', $apiEndpoint, $parameters);
    }

    /**
     * Reusable code to send the HTTP Request to the API endpoint.
     *
     * @param string $method
     * @param string $apiEndpoint
     * @param array  $parameters
     *
     * @return HttpResponse
     */
    private function httpRequest(string $method, string $apiEndpoint, array $parameters = [])
    {
        $curl = curl_init();

        // Verbose output
        //curl_setopt($curl, CURLOPT_VERBOSE, 1);

        // HTTP Method
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        if ('GET' === $method) {
            // API Endpoint
            $apiResource = sprintf('%s%s%s', $this->server, $apiEndpoint, (!empty($parameters) ? sprintf('?%s', http_build_query($parameters)) : ''));
            curl_setopt($curl, CURLOPT_URL, $apiResource);
        } else {
            // API Endpoint
            $apiResource = sprintf('%s%s', $this->server, $apiEndpoint);
            curl_setopt($curl, CURLOPT_URL, $apiResource);

            // HTTP Body
            if (!empty($parameters)) {
                $payload = json_encode($parameters);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            }
        }

        // Set the expected Content Type
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        // SSL Certificate and Key
        curl_setopt($curl, CURLOPT_CAINFO, $this->pathToInfo);
        curl_setopt($curl, CURLOPT_SSLKEY, $this->pathToKey);
        curl_setopt($curl, CURLOPT_SSLCERT, $this->pathToCert);
        // 1 to check the existence of a common name in the SSL peer certificate.
        // 2 to check the existence of a common name and also verify that it matches the hostname provided.
        // 0 to not check the names. In production environments the value of this option should be kept at 2 (default value).
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        // FALSE to stop cURL from verifying the peer's certificate.
        // TRUE by default as of cURL 7.10. Default bundle installed as of cURL 7.10.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

        // Get HttpResponse Headers
        curl_setopt($curl, CURLOPT_HEADER, true);

        // Return the transfer as a string of the return value of curl_exec() instead of outputting it out directly
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);

        // The maximum number of seconds to allow cURL functions to execute.
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); //timeout in seconds

        // Handle the response
        $response = curl_exec($curl);

        if (!empty(curl_error($curl))) {
            throw new HttpRequestException(curl_error($curl), curl_errno($curl));
        }

        if (empty($response)) {
            $httpResponse = new HttpResponse(401, '');
        } else {
            $lines = explode(PHP_EOL, $response);

            preg_match('/HTTP\/(\d+)\.(\d+)\s(\d+)/', reset($lines), $matchesForStatusCode);

            // Some times, FinBlocks API Server might return the "100 Continue" status code. When this happens, we need
            // to remove the 2 first lines of the header, so we can validate the expected status code for the request.
            if (100 === (int) end($matchesForStatusCode)) {
                unset($lines[0]);
                unset($lines[1]);

                preg_match('/HTTP\/(\d+)\.(\d+)\s(\d+)/', reset($lines), $matchesForStatusCode);
            }

            $httpResponse = new HttpResponse(end($matchesForStatusCode), end($lines));
        }

        if (HttpResponse::ACCEPTED === $httpResponse->getStatusCode()) {
            do {
                // Sleep for 1 second, giving some time to the API
                sleep(1);
                // Get the URL that we need from the 202 Response
                $assoc = json_decode($httpResponse->getBody(), true);
                $url = $assoc['url'];
                // Get the expected response re-sending the API request
                $httpResponse = $this->get($url);
            } while (HttpResponse::ACCEPTED === $httpResponse->getStatusCode());
        }

        return $httpResponse;
    }
}

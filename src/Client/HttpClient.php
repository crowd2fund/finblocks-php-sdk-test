<?php

namespace FinBlocks\Client;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class HttpClient
{
    /**
     * @var string
     */
    private $pathToSslCert;

    /**
     * @var string
     */
    private $pathToSslInfo;

    /**
     * @var string
     */
    private $pathToSslPath;

    /**
     * @var bool
     */
    private $sandbox;

    /**
     * @var string
     */
    private $server;

    /**
     * HttpClient constructor.
     *
     * @param string|null $pathToSslCert
     * @param string|null $pathToSslInfo
     * @param string|null $pathToSslPath
     * @param bool        $sandbox
     */
    public function __construct(string $pathToSslCert = null, string $pathToSslInfo = null, string $pathToSslPath = null, bool $sandbox = false)
    {
        $this->pathToSslCert = $pathToSslCert;
        $this->pathToSslInfo = $pathToSslInfo;
        $this->pathToSslPath = $pathToSslPath;
        $this->sandbox = $sandbox;
        $this->server = sprintf('https://api.%sfinblocks.net/v1', $this->sandbox ? 'sandbox.' : '');
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
     * Send a POST request to the given API endpoint.
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
     * Send a POST request to the given API endpoint.
     *
     * @param string $apiEndpoint
     * @param array  $parameters
     *
     * @return HttpResponse
     */
    public function patch(string $apiEndpoint, array $parameters = []): HttpResponse
    {
        return $this->httpRequest('PATCH', $apiEndpoint, $parameters);
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

        // HTTP Method
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        if ('GET' === $method) {
            // HTTP Parameters
            $query = http_build_query($parameters);

            // API Endpoint
            curl_setopt($curl, CURLOPT_URL, sprintf('%s%s?%s', $this->server, $apiEndpoint, $query));
        } else {
            // API Endpoint
            curl_setopt($curl, CURLOPT_URL, sprintf('%s%s', $this->server, $apiEndpoint));

            // HTTP Parameters
            $body = json_encode($parameters);

            // HTTP Parameters
            if (!empty($body)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            }
        }

        // Get HttpResponse Headers
        curl_setopt($curl, CURLOPT_HEADER, true);

        // Return the transfer as a string of the return value of curl_exec() instead of outputting it out directly
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        // Handle the response
        $response = curl_exec($curl);

        $lines = explode(PHP_EOL, $response);

        preg_match('/HTTP\/(\d+)\.(\d+)\s(\d+)/', reset($lines), $matchesForStatusCode);

        $httpResponse = new HttpResponse(end($matchesForStatusCode), end($lines));

        return $httpResponse;
    }
}

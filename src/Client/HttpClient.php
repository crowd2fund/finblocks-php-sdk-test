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
     * @param string $key     Path to the SSL Certificate Key file
     * @param string $cert    Path to the SSL Certificate file
     * @param string $info    Path to the CA Certificate file
     * @param bool   $sandbox Use SANDBOX environment
     */
    public function __construct(string $key, string $cert, string $info, bool $sandbox = false)
    {
        $this->pathToKey = $key;
        $this->pathToCert = $cert;
        $this->pathToInfo = $info;

        $this->server = sprintf('https://api.%sfinblocks.net/v1', ($sandbox ? 'sandbox.' : ''));
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
                $body = json_encode($parameters);

                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            }
        }

        // SSL Certificate and Key
        curl_setopt($curl, CURLOPT_CAINFO, $this->pathToInfo);
        curl_setopt($curl, CURLOPT_SSLKEY, $this->pathToKey);
        curl_setopt($curl, CURLOPT_SSLCERT, $this->pathToCert);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);

        // Get HttpResponse Headers
        curl_setopt($curl, CURLOPT_HEADER, true);

        // Return the transfer as a string of the return value of curl_exec() instead of outputting it out directly
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        // Handle the response
        $response = curl_exec($curl);

        if (empty($response)) {
            $httpResponse = new HttpResponse(401, '');
        } else {
            $lines = explode(PHP_EOL, $response);

            preg_match('/HTTP\/(\d+)\.(\d+)\s(\d+)/', reset($lines), $matchesForStatusCode);

            $httpResponse = new HttpResponse(end($matchesForStatusCode), end($lines));
        }

        return $httpResponse;
    }
}

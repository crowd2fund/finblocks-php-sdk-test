<?php

namespace FinBlocks\Exception;

use FinBlocks\Client\HttpResponse;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class HttpClientException extends AbstractHttpException
{
    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function badRequest(HttpResponse $response)
    {
        return new self('The parameters passed to the API were invalid.', 400, $response);
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function unauthorized(HttpResponse $response)
    {
        return new self('Your credentials are incorrect.', 401, $response);
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function forbidden(HttpResponse $response)
    {
        return new self('The request was valid, but the server is refusing action.', 403, $response);
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function notFound(HttpResponse $response)
    {
        return new self('The requested resource could not be found but may be available in the future.', 404, $response);
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function payloadTooLarge(HttpResponse $response)
    {
        return new self('The request is larger than the server is willing or able to process.', 413, $response);
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function tooManyRequests(HttpResponse $response)
    {
        return new self('You have sent too many requests in a given amount of time.', 429, $response);
    }
}

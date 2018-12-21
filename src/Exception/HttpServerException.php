<?php

namespace FinBlocks\Exception;

use FinBlocks\Client\HttpResponse;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 * @version   1.0.0
 */
class HttpServerException extends AbstractHttpException
{
    /**
     * @param HttpResponse $response
     *
     * @return HttpServerException
     */
    public static function internalServerError(HttpResponse $response)
    {
        return new self(
            'An unexpected internal server error occurred. Please contact FinBlocks\'s support.',
            500,
            $response
        );
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpServerException
     */
    public static function serviceUnavailableError(HttpResponse $response)
    {
        return new self(
            'The server is currently unavailable (because it is overloaded or down for maintenance). Please try again shortly.',
            503,
            $response
        );
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpServerException
     */
    public static function serverError(HttpResponse $response)
    {
        return new self(
            'An unexpected internal server error occurred. Please contact FinBlocks\'s support.',
            $response->getStatusCode(),
            $response
        );
    }
}

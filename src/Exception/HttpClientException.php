<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Exception;

use FinBlocks\Client\HttpResponse;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
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
        return new self($response, 'The parameters passed to the API were invalid.');
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function unauthorized(HttpResponse $response)
    {
        return new self($response, 'Your credentials are incorrect.');
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function forbidden(HttpResponse $response)
    {
        return new self($response, 'The request was valid, but the server is refusing action.');
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function notFound(HttpResponse $response)
    {
        return new self($response, 'The requested resource could not be found but may be available in the future.');
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function payloadTooLarge(HttpResponse $response)
    {
        return new self($response, 'The request is larger than the server is willing or able to process.');
    }

    /**
     * @param HttpResponse $response
     *
     * @return HttpClientException
     */
    public static function tooManyRequests(HttpResponse $response)
    {
        return new self($response, 'You have sent too many requests in a given amount of time.');
    }
}

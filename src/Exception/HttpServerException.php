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
            $response,
            'An unexpected internal server error occurred. Please contact FinBlocks\'s support.'
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
            $response,
            'The server is currently unavailable (because it is overloaded or down for maintenance). Please try again shortly.'
        );
    }
}

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
abstract class AbstractHttpException extends \RuntimeException
{
    /**
     * @var HttpResponse
     */
    private $response;

    /**
     * @var int
     */
    private $responseCode;

    /**
     * @var string
     */
    private $responseBody;

    /**
     * @param string       $message
     * @param HttpResponse $response
     */
    public function __construct($message, HttpResponse $response)
    {
        parent::__construct($message, $response->getStatusCode());

        $this->response = $response;
        $this->responseCode = $response->getStatusCode();
        $this->responseBody = $response->getBody();
    }

    /**
     * @return HttpResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }
}

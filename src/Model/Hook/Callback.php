<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Hook;

use FinBlocks\Exception\FinBlocksException;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Callback
{
    /**
     * @var string
     */
    private $eventId;

    /**
     * @var string
     */
    private $eventName;

    /**
     * @var string
     */
    private $resourceId;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $payload;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $sha256HmacHash;

    /**
     * @var string
     */
    private $signature;

    /**
     * @var bool
     */
    private $trusted;

    /**
     * Callback constructor.
     *
     * @param string $jsonData
     * @param string $secret
     * @param string $signature
     */
    private function __construct(string $jsonData, string $secret, string $signature)
    {
        try {
            if (empty($jsonData)) {
                throw new \InvalidArgumentException('JSON payload expected');
            }

            $this->payload = $jsonData;
            $this->secret = $secret;
            $this->sha256HmacHash = hash_hmac('sha256', $this->payload, $this->secret);
            $this->signature = $signature;
            $this->trusted = ($this->sha256HmacHash === $this->signature);

            $arrayData = json_decode($jsonData, true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
            }

            foreach ($arrayData as $property => $content) {
                if (!property_exists($this, $property)) {
                    throw new \RuntimeException('JSON payload has an unexpected property');
                }

                $this->$property = $content;
            }
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    public static function createFromPayload(string $jsonData, string $secret, string $signature)
    {
        return new self($jsonData, $secret, $signature);
    }

    /**
     * @return string
     */
    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return $this->eventName;
    }

    /**
     * @return string
     */
    public function getResourceId(): string
    {
        return $this->resourceId;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isTrusted(): bool
    {
        return true === $this->trusted;
    }
}

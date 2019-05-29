<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Mandate;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Mandate implements BaseModelInterface
{
    const STATUS_MANDATE_CREATED = 'created';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $flowId;

    /**
     * @var string
     */
    private $accountHolderId;

    /**
     * @var string
     */
    private $status;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var string
     */
    private $provider;

    /**
     * @var string
     */
    private $providerId;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Mandate constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
        try {
            $arrayData = json_decode($jsonData, true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
            }

            foreach ($arrayData as $property => $content) {
                switch ($property) {
                    case 'createdAt':
                        $this->$property = !empty($content) ? new \DateTime($content) : $content;
                        break;
                    default:
                        $this->$property = $content;
                }
            }
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function create()
    {
        throw new FinBlocksException('Impossible to instantiate an empty Mandate');
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromPayload(string $jsonData)
    {
        return new self($jsonData);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFlowId(): string
    {
        return $this->flowId;
    }

    /**
     * @return string
     */
    public function getAccountHolderId(): string
    {
        return $this->accountHolderId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return true === $this->active;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return string
     */
    public function getProviderId(): string
    {
        return $this->providerId;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        throw new FinBlocksException('Impossible to create the Mandate');
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Mandate');
    }
}

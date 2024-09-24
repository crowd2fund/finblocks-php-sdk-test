<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Deposit;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Money\Money;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class DepositCard extends AbstractDeposit
{
    const string TYPE = 'card';

    /**
     * @var bool
     */
    private $secureMode = false;

    /**
     * @var string
     */
    private $cv2;

    /**
     * DepositCard constructor.
     *
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct();

        $this->type = self::TYPE;

        if (!empty($jsonData)) {
            try {
                $arrayData = json_decode($jsonData, true);

                if (JSON_ERROR_NONE !== json_last_error()) {
                    throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
                }

                foreach ($arrayData as $property => $content) {
                    switch ($property) {
                        case 'amount':
                            $this->$property = Money::createFromPayload(json_encode($content));
                            break;
                        case 'createdAt':
                        case 'executedAt':
                        case 'expiresAt':
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
    }

    /**
     * {@inheritdoc}
     */
    public static function create()
    {
        return new self();
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromPayload(string $jsonData)
    {
        return new self($jsonData);
    }

    /**
     * The Card ID.
     *
     * @param string $reference
     */
    public function setReference(string $reference)
    {
        $this->reference = $reference;
    }

    /**
     * @param bool $secureMode
     */
    public function setSecureMode(bool $secureMode)
    {
        $this->secureMode = $secureMode;
    }

    /**
     * @return bool
     */
    public function isSecureMode(): bool
    {
        return true === $this->secureMode;
    }

    /**
     * @param string $cv2
     */
    public function setCv2(string $cv2)
    {
        $this->cv2 = $cv2;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return array_merge(
            parent::httpCreate(),
            [
                'reference' => $this->reference,
                'secureMode' => $this->secureMode,
                'cv2' => $this->cv2
            ]
        );
    }
}

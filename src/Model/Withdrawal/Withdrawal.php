<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Withdrawal;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;
use FinBlocks\Model\Money\Money;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Withdrawal implements BaseModelInterface
{
    const NATURE = 'withdrawal';

    const STATUS_CREATED = 'created';
    const STATUS_SUCCEEDED = 'succeeded';
    const STATUS_FAILED = 'failed';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $walletId;

    /**
     * @var string
     */
    private $bankAccountId;

    /**
     * @var string|null
     */
    private $bankWireReference;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $nature = self::NATURE;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var Money
     */
    private $fees;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $executedAt;

    /**
     * Withdrawal constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
        if (!empty($jsonData)) {
            try {
                $arrayData = json_decode($jsonData, true);

                if (JSON_ERROR_NONE !== json_last_error()) {
                    throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
                }

                foreach ($arrayData as $property => $content) {
                    switch ($property) {
                        case 'amount':
                        case 'fees':
                            $this->$property = Money::createFromPayload(json_encode($content));
                            break;
                        case 'createdAt':
                        case 'executedAt':
                            $this->$property = !empty($content) ? new \DateTime($content) : $content;
                            break;
                        default:
                            $this->$property = $content;
                    }
                }
            } catch (\Throwable $throwable) {
                throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
            }
        } else {
            $this->amount = Money::create();
            $this->fees = Money::create();
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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $walletId
     */
    public function setWalletId(string $walletId)
    {
        $this->walletId = $walletId;
    }

    /**
     * @return string
     */
    public function getWalletId(): string
    {
        return $this->walletId;
    }

    /**
     * @param string $bankAccountId
     */
    public function setBankAccountId(string $bankAccountId)
    {
        $this->bankAccountId = $bankAccountId;
    }

    /**
     * @return string
     */
    public function getBankAccountId(): string
    {
        return $this->bankAccountId;
    }

    /**
     * @param string|null $bankWireReference
     */
    public function setBankWireReference(string $bankWireReference = null)
    {
        $this->bankWireReference = $bankWireReference;
    }

    /**
     * @return string|null
     */
    public function getBankWireReference()
    {
        return $this->bankWireReference;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(string $label = null)
    {
        $this->label = $label;
    }

    /**
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string|null $tag
     */
    public function setTag(string $tag = null)
    {
        $this->tag = $tag;
    }

    /**
     * @return string|null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getNature(): string
    {
        return $this->nature;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return Money
     */
    public function getFees(): Money
    {
        return $this->fees;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getExecutedAt()
    {
        return $this->executedAt;
    }

    /**
     * Converts the Model to an array with all fields and format that we can use for the POST request.
     *
     * @return array
     */
    public function httpCreate(): array
    {
        return [
            'walletId'          => $this->walletId,
            'bankAccountId'     => $this->bankAccountId,
            'bankWireReference' => $this->bankWireReference,
            'amount'            => $this->amount->httpCreate(),
            'fees'              => $this->fees->httpCreate(),
            'label'             => $this->label,
            'tag'               => $this->tag,
        ];
    }

    /**
     * Converts the Model to an array with all fields and format that we can use for the PUT request.
     *
     * @return array
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Withdrawal');
    }
}

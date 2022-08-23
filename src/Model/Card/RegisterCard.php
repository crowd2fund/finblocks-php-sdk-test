<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Card;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;

/**
 * @author    Liviu Dragulin <liviu@crowd2fund.com>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class RegisterCard implements BaseModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $accountHolderId;

    /**
     * @var string
     */
    private $cardToken;

    /**
     * @var string
     */
    private $receiptId;

    /**
     * @var string
     */
    private $issuer;

    /**
     * @var string
     */
    private $lastFour;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Card constructor.
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
                        case 'createdAt':
                            $this->$property = !empty($content) ? new \DateTime($content) : $content;
                            break;
                        case 'endDate':
                            $this->$property = !empty($content) ? \DateTime::createFromFormat('my', $content) : null;
                            $this->$property->setDate($this->$property->format('Y'), $this->$property->format('m'), $this->$property->format('t'));
                            $this->$property->setTime(23, 59, 59);
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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $accountHolderId
     */
    public function setAccountHolderId(string $accountHolderId)
    {
        $this->accountHolderId = $accountHolderId;
    }

    /**
     * @return string
     */
    public function getAccountHolderId(): string
    {
        return $this->accountHolderId;
    }

    /**
     * @param string $cardToken
     */
    public function setCardToken(string $cardToken)
    {
        $this->cardToken = $cardToken;
    }

    /**
     * @param string $receiptId
     */
    public function setReceiptId(string $receiptId)
    {
        $this->receiptId = $receiptId;
    }

    /**
     * @return string
     */
    public function getIssuer(): string
    {
        return $this->issuer;
    }

    /**
     * @return string
     */
    public function getLastFour(): string
    {
        return $this->lastFour;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
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
     * @return bool
     */
    public function isActive(): bool
    {
        return true === $this->active;
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
        return [
            'accountHolderId' => $this->accountHolderId,
            'cardToken'       => $this->cardToken,
            'receiptId'       => $this->receiptId,
            'label'           => $this->label,
            'tag'             => $this->tag,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Card');
    }
}

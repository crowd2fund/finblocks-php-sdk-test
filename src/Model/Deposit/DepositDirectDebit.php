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
use FinBlocks\Model\Address\Address;
use FinBlocks\Model\Money\Money;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class DepositDirectDebit extends AbstractDeposit
{
    const TYPE = 'directDebit';

    /**
     * @var string
     */
    private $mandateId;

    /**
     * DepositDirectDebit constructor.
     *
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct();

        if (!empty($jsonData)) {
            try {
                $arrayData = json_decode($jsonData, true);

                if (JSON_ERROR_NONE !== json_last_error()) {
                    throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
                }

                foreach ($arrayData as $property => $content) {
                    switch ($property) {
                        case 'billingAddress':
                            $this->$property = Address::createFromPayload(json_encode($content));
                            break;
                        case 'debitedAmount':
                        case 'creditedAmount':
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
     * @param string $mandateId
     */
    public function setMandateId(string $mandateId)
    {
        $this->mandateId = $mandateId;
    }

    /**
     * @return string
     */
    public function getMandateId(): string
    {
        return $this->mandateId;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return array_merge(
            parent::httpCreate(),
            ['mandateId' => $this->mandateId]
        );
    }
}

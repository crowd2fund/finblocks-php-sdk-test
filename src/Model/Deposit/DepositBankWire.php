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
final class DepositBankWire extends AbstractDeposit
{
    const TYPE = 'bankWire';

    /**
     * DepositBankWire constructor.
     *
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct();

        $this->type = self::TYPE;
        $this->declaredDebitedAmount = Money::create();
        $this->declaredFees = Money::create();

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
                        case 'amount':
                        case 'debitedAmount':
                        case 'creditedAmount':
                        case 'fees':
                        case 'declaredDebitedAmount':
                        case 'declaredFees':
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
     * @var Money
     */
    private $declaredDebitedAmount;

    /**
     * @var Money
     */
    private $declaredFees;

    /**
     * @var string
     */
    private $wireReference;

    /**
     * @return Money
     */
    public function getDeclaredDebitedAmount(): Money
    {
        return $this->declaredDebitedAmount;
    }

    /**
     * @return Money
     */
    public function getDeclaredFees(): Money
    {
        return $this->declaredFees;
    }

    /**
     * @return string
     */
    public function getWireReference(): string
    {
        return $this->wireReference;
    }
}

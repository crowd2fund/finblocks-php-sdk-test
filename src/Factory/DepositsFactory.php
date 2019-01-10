<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Factory;

use FinBlocks\Model\Deposit\DepositBankWire;
use FinBlocks\Model\Deposit\DepositCard;
use FinBlocks\Model\Deposit\DepositDirectDebit;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class DepositsFactory
{
    /**
     * Creates a new Model.
     *
     * @return DepositBankWire
     */
    public function createBankWire(): DepositBankWire
    {
        return DepositBankWire::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return DepositBankWire
     */
    public function createBankWireFromPayload(string $jsonData): DepositBankWire
    {
        return DepositBankWire::createFromPayload($jsonData);
    }

    /**
     * Creates a new Model.
     *
     * @return DepositCard
     */
    public function createCard(): DepositCard
    {
        return DepositCard::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return DepositCard
     */
    public function createCardFromPayload(string $jsonData): DepositCard
    {
        return DepositCard::createFromPayload($jsonData);
    }

    /**
     * Creates a new Model.
     *
     * @return DepositDirectDebit
     */
    public function createDirectDebit(): DepositDirectDebit
    {
        return DepositDirectDebit::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return DepositDirectDebit
     */
    public function createDirectDebitFromPayload(string $jsonData): DepositDirectDebit
    {
        return DepositDirectDebit::createFromPayload($jsonData);
    }
}

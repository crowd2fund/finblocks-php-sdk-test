<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\Deposit\DepositBankWire;
use FinBlocks\Model\Deposit\DepositCard;
use FinBlocks\Model\Deposit\DepositDirectDebit;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class DepositsFactory
{
    /**
     * Creates a new Bank Wire Deposit's Model.
     *
     * @return DepositBankWire
     */
    public function createBankWire(): DepositBankWire
    {
        return new DepositBankWire();
    }

    /**
     * Creates a new Card Deposit's Model.
     *
     * @return DepositCard
     */
    public function createCard(): DepositCard
    {
        return new DepositCard();
    }

    /**
     * Creates a new Direct Debit Deposit's Model.
     *
     * @return DepositDirectDebit
     */
    public function createDirectDebit(): DepositDirectDebit
    {
        return new DepositDirectDebit();
    }
}

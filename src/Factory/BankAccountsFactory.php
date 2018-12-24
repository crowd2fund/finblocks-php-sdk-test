<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\BankAccount\BankAccountCa;
use FinBlocks\Model\BankAccount\BankAccountGb;
use FinBlocks\Model\BankAccount\BankAccountIban;
use FinBlocks\Model\BankAccount\BankAccountOther;
use FinBlocks\Model\BankAccount\BankAccountUs;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class BankAccountsFactory
{
    /**
     * Creates a new CA's Bank Account Model.
     *
     * @return BankAccountCa
     */
    public function createCa(): BankAccountCa
    {
        return new BankAccountCa();
    }
    /**
     * Creates a new GB's Bank Account Model.
     *
     * @return BankAccountGb
     */
    public function createGb(): BankAccountGb
    {
        return new BankAccountGb();
    }
    /**
     * Creates a new IBAN's Bank Account Model.
     *
     * @return BankAccountIban
     */
    public function createIban(): BankAccountIban
    {
        return new BankAccountIban();
    }
    /**
     * Creates a new OTHER's Bank Account Model.
     *
     * @return BankAccountOther
     */
    public function createOther(): BankAccountOther
    {
        return new BankAccountOther();
    }
    /**
     * Creates a new US's Bank Account Model.
     *
     * @return BankAccountUs
     */
    public function createUs(): BankAccountUs
    {
        return new BankAccountUs();
    }
}

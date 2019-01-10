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
 *
 * @since   1.0.0
 */
class BankAccountsFactory
{
    /**
     * Creates a new Model.
     *
     * @return BankAccountCa
     */
    public function createCa(): BankAccountCa
    {
        return BankAccountCa::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return BankAccountCa
     */
    public function createCaFromPayload(string $jsonData): BankAccountCa
    {
        return BankAccountCa::createFromPayload($jsonData);
    }

    /**
     * Creates a new Model.
     *
     * @return BankAccountGb
     */
    public function createGb(): BankAccountGb
    {
        return BankAccountGb::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return BankAccountGb
     */
    public function createGbFromPayload(string $jsonData): BankAccountGb
    {
        return BankAccountGb::createFromPayload($jsonData);
    }

    /**
     * Creates a new Model.
     *
     * @return BankAccountIban
     */
    public function createIban(): BankAccountIban
    {
        return BankAccountIban::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return BankAccountIban
     */
    public function createIbanFromPayload(string $jsonData): BankAccountIban
    {
        return BankAccountIban::createFromPayload($jsonData);
    }

    /**
     * Creates a new Model.
     *
     * @return BankAccountOther
     */
    public function createOther(): BankAccountOther
    {
        return BankAccountOther::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return BankAccountOther
     */
    public function createOtherFromPayload(string $jsonData): BankAccountOther
    {
        return BankAccountOther::createFromPayload($jsonData);
    }

    /**
     * Creates a new Model.
     *
     * @return BankAccountUs
     */
    public function createUs(): BankAccountUs
    {
        return BankAccountUs::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return BankAccountUs
     */
    public function createUsFromPayload(string $jsonData): BankAccountUs
    {
        return BankAccountUs::createFromPayload($jsonData);
    }
}

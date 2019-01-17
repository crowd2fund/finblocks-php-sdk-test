<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\API;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class ApiEndpoints extends AbstractHttpApi
{
    /**
     * API Endpoints for Account Holders management.
     *
     * @return AccountHolders
     */
    public function accountHolders(): AccountHolders
    {
        return new AccountHolders($this->httpClient);
    }

    /**
     * API Endpoints for Bank Accounts management.
     *
     * @return BankAccounts
     */
    public function bankAccounts(): BankAccounts
    {
        return new BankAccounts($this->httpClient);
    }

    /**
     * API Endpoints for Documents management.
     *
     * @return Documents
     */
    public function documents(): Documents
    {
        return new Documents($this->httpClient);
    }

    /**
     * API Endpoints for KYC management.
     *
     * @return KYC
     */
    public function kyc(): KYC
    {
        return new KYC($this->httpClient);
    }

    /**
     * API Endpoints for Mandates management.
     *
     * @return Mandates
     */
    public function mandates(): Mandates
    {
        return new Mandates($this->httpClient);
    }

    /**
     * API Endpoints for Wallets management.
     *
     * @return Wallets
     */
    public function wallets(): Wallets
    {
        return new Wallets($this->httpClient);
    }
}

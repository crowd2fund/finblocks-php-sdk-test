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

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Exception\SerializerException;
use FinBlocks\Model\BankAccount\AbstractBankAccount;
use FinBlocks\Model\BankAccount\BankAccountCa;
use FinBlocks\Model\BankAccount\BankAccountGb;
use FinBlocks\Model\BankAccount\BankAccountIban;
use FinBlocks\Model\BankAccount\BankAccountOther;
use FinBlocks\Model\BankAccount\BankAccountUs;
use FinBlocks\Model\Pagination\BankAccountsPagination;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class BankAccounts extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Account Holders.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return BankAccountsPagination
     */
    public function list(int $page = 1, int $perPage = 20): BankAccountsPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/account-holders', ['offset' => $offset, 'perPage' => $perPage]);

            return $this->hydrateResponse($httpResponse, BankAccountsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates an Account Holder.
     *
     * @param AbstractBankAccount $bankAccount
     *
     * @throws FinBlocksException
     *
     * @return AbstractBankAccount
     */
    public function create(AbstractBankAccount $bankAccount): AbstractBankAccount
    {
        try {
            $apiEndpoint = $model = null;

            switch ($bankAccount->getType()) {
                case BankAccountGb::TYPE:
                    $model = BankAccountGb::class;
                    $apiEndpoint = '/bank-accounts/gb';
                    break;
                case BankAccountIban::TYPE:
                    $model = BankAccountIban::class;
                    $apiEndpoint = '/bank-accounts/iban';
                    break;
                case BankAccountCa::TYPE:
                    $model = BankAccountCa::class;
                    $apiEndpoint = '/bank-accounts/ca';
                    break;
                case BankAccountUs::TYPE:
                    $model = BankAccountUs::class;
                    $apiEndpoint = '/bank-accounts/us';
                    break;
                case BankAccountOther::TYPE:
                    $model = BankAccountOther::class;
                    $apiEndpoint = '/bank-accounts/other';
                    break;
            }

            $httpResponse = $this->httpPost($apiEndpoint, $bankAccount->httpCreate());

            return $this->hydrateResponse($httpResponse, $model);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a Bank Account.
     *
     * @param string $bankAccountId
     *
     * @throws FinBlocksException
     *
     * @return AbstractBankAccount
     */
    public function show(string $bankAccountId): AbstractBankAccount
    {
        try {
            Assert::stringNotEmpty($bankAccountId, '`bankAccountId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/bank-accounts/%s', $bankAccountId));

            $arrayResponse = json_decode($httpResponse->getBody(), true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \RuntimeException(json_last_error_msg(), json_last_error());
            }

            $model = null;

            switch ($arrayResponse['type']) {
                case BankAccountGb::TYPE:
                    $model = BankAccountGb::class;
                    break;
                case BankAccountIban::TYPE:
                    $model = BankAccountIban::class;
                    break;
                case BankAccountCa::TYPE:
                    $model = BankAccountCa::class;
                    break;
                case BankAccountUs::TYPE:
                    $model = BankAccountUs::class;
                    break;
                case BankAccountOther::TYPE:
                    $model = BankAccountOther::class;
                    break;
            }

            return $this->hydrateResponse($httpResponse, $model);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Invalidates the given Bank Account ID, so the Account Holder won't be able to use it again to withdraw funds or
     * to process Direct Debit Deposits through a Mandate.
     *
     * @param string $bankAccountId
     *
     * @throws FinBlocksException
     *
     * @return null
     */
    public function deactivate(string $bankAccountId)
    {
        try {
            Assert::stringNotEmpty($bankAccountId, '`bankAccountId` argument must be a not empty string');

            $httpResponse = $this->httpDelete(sprintf('/bank-accounts/%s', $bankAccountId));

            return $this->hydrateResponse($httpResponse);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a collection of Bank Accounts that belong to the given Account Holder.
     *
     * @param string $accountHolderId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return BankAccountsPagination
     */
    public function listByAccountHolder(string $accountHolderId, int $page = 1, int $perPage = 20): BankAccountsPagination
    {
        try {
            Assert::stringNotEmpty($accountHolderId, '`accountHolderId` argument must be a not empty string');

            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet(
                sprintf('/account-holders/%s/bank-accounts', $accountHolderId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, BankAccountsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}

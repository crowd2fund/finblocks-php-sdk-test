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
use FinBlocks\Model\Pagination\TransactionPagination;
use FinBlocks\Model\Pagination\WalletsPagination;
use FinBlocks\Model\Wallet\Wallet;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Wallets extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Wallets.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return WalletsPagination
     */
    public function list(int $page = 1, int $perPage = 20): WalletsPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/wallets', ['offset' => $offset, 'perPage' => $perPage]);

            return $this->hydrateResponse($httpResponse, WalletsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates a Wallet.
     *
     * @param Wallet $wallet
     *
     * @throws FinBlocksException
     *
     * @return Wallet
     */
    public function create(Wallet $wallet): Wallet
    {
        try {
            $httpResponse = $this->httpPost('/wallets', $wallet->httpCreate());

            return $this->hydrateResponse($httpResponse, Wallet::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a Wallet.
     *
     * @param string $walletId
     *
     * @throws FinBlocksException
     *
     * @return Wallet
     */
    public function show(string $walletId): Wallet
    {
        try {
            Assert::stringNotEmpty($walletId, '`walletId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/wallets/%s', $walletId));

            return $this->hydrateResponse($httpResponse, Wallet::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a collection of Wallets that belong to the given Account Holder.
     *
     * @param string $accountHolderId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return WalletsPagination
     */
    public function listByAccountHolder(string $accountHolderId, int $page = 1, int $perPage = 20): WalletsPagination
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
                sprintf('/account-holders/%s/wallets', $accountHolderId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, WalletsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a Wallet.
     *
     * @param string $walletId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return TransactionPagination
     */
    public function statement(string $walletId, int $page = 1, int $perPage  = 10): TransactionPagination
    {
        try {
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');
            Assert::stringNotEmpty($walletId, '`walletId` argument must be a not empty string');

            $offset = ($page - 1) * $perPage;

            $httpResponse = $this->httpGet(
                sprintf('/wallets/%s/statement', $walletId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, TransactionPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}

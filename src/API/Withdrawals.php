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
use FinBlocks\Model\Pagination\WithdrawalsPagination;
use FinBlocks\Model\Withdrawal\Withdrawal;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Withdrawals extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Withdrawals.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return WithdrawalsPagination
     */
    public function list(int $page = 1, int $perPage = 20): WithdrawalsPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/withdrawals', ['offset' => $offset, 'perPage' => $perPage]);

            return $this->hydrateResponse($httpResponse, WithdrawalsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates a Withdrawal.
     *
     * @param Withdrawal $withdrawal
     *
     * @throws FinBlocksException
     *
     * @return Withdrawal
     */
    public function create(Withdrawal $withdrawal): Withdrawal
    {
        try {
            $httpResponse = $this->httpPost('/withdrawals', $withdrawal->httpCreate());

            return $this->hydrateResponse($httpResponse, Withdrawal::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a Withdrawal.
     *
     * @param string $withdrawalId
     *
     * @throws FinBlocksException
     *
     * @return Withdrawal
     */
    public function show(string $withdrawalId): Withdrawal
    {
        try {
            Assert::stringNotEmpty($withdrawalId, '`withdrawalId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/withdrawals/%s', $withdrawalId));

            return $this->hydrateResponse($httpResponse, Withdrawal::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a collection of Withdrawals are linked to the given Wallet.
     *
     * @param string $walletId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return WithdrawalsPagination
     */
    public function listByWallet(string $walletId, int $page = 1, int $perPage = 20): WithdrawalsPagination
    {
        try {
            Assert::stringNotEmpty($walletId, '`walletId` argument must be a not empty string');

            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet(
                sprintf('/wallets/%s/withdrawals', $walletId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, WithdrawalsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}

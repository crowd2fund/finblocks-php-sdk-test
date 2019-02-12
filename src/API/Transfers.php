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
use FinBlocks\Model\Pagination\TransfersPagination;
use FinBlocks\Model\Transfer\Transfer;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Transfers extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Transfers.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return TransfersPagination
     */
    public function list(int $page = 1, int $perPage = 20): TransfersPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/transfers', ['offset' => $offset, 'perPage' => $perPage]);

            return $this->hydrateResponse($httpResponse, TransfersPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates a Transfer.
     *
     * @param Transfer $transfer
     *
     * @throws FinBlocksException
     *
     * @return Transfer
     */
    public function create(Transfer $transfer): Transfer
    {
        try {
            $httpResponse = $this->httpPost('/transfers', $transfer->httpCreate());

            return $this->hydrateResponse($httpResponse, Transfer::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a Deposit.
     *
     * @param string $transferId
     *
     * @throws FinBlocksException
     *
     * @return Transfer
     */
    public function show(string $transferId): Transfer
    {
        try {
            Assert::stringNotEmpty($transferId, '`transferId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/transfers/%s', $transferId));

            return $this->hydrateResponse($httpResponse, Transfer::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a collection of Transfers are linked to the given Wallet.
     *
     * @param string $walletId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return TransfersPagination
     */
    public function listByWallet(string $walletId, int $page = 1, int $perPage = 20): TransfersPagination
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
                sprintf('/wallets/%s/transfers', $walletId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, TransfersPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}

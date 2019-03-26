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
use FinBlocks\Model\Deposit\AbstractDeposit;
use FinBlocks\Model\Deposit\DepositBankWire;
use FinBlocks\Model\Deposit\DepositCard;
use FinBlocks\Model\Deposit\DepositDirectDebit;
use FinBlocks\Model\Pagination\DepositsPagination;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Deposits extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Deposits.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return DepositsPagination
     */
    public function list(int $page = 1, int $perPage = 20): DepositsPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/deposits', ['offset' => $offset, 'perPage' => $perPage]);

            return $this->hydrateResponse($httpResponse, DepositsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates a Deposit.
     *
     * @param AbstractDeposit $deposit
     *
     * @throws FinBlocksException
     *
     * @return AbstractDeposit
     */
    public function create(AbstractDeposit $deposit): AbstractDeposit
    {
        try {
            $apiEndpoint = $model = null;

            switch ($deposit->getType()) {
                case DepositBankWire::TYPE:
                    $apiEndpoint = '/deposits/bank-wire';
                    $model = DepositBankWire::class;
                    break;
                case DepositCard::TYPE:
                    $apiEndpoint = '/deposits/card';
                    $model = DepositCard::class;
                    break;
                case DepositDirectDebit::TYPE:
                    $apiEndpoint = '/deposits/direct-debit';
                    $model = DepositDirectDebit::class;
                    break;
            }

            $httpResponse = $this->httpPost($apiEndpoint, $deposit->httpCreate());

            return $this->hydrateResponse($httpResponse, $model);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a Deposit.
     *
     * @param string $depositId
     *
     * @throws FinBlocksException
     *
     * @return AbstractDeposit
     */
    public function show(string $depositId): AbstractDeposit
    {
        try {
            Assert::stringNotEmpty($depositId, '`depositId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/deposits/%s', $depositId));

            $arrayResponse = json_decode($httpResponse->getBody(), true);
            $arrayResponse = is_array($arrayResponse) ? $arrayResponse : [];
            $arrayResponse['type'] = $arrayResponse['type'] ?? null;

            $model = null;

            switch ($arrayResponse['type']) {
                case DepositBankWire::TYPE:
                    $model = DepositBankWire::class;
                    break;
                case DepositCard::TYPE:
                    $model = DepositCard::class;
                    break;
                case DepositDirectDebit::TYPE:
                    $model = DepositDirectDebit::class;
                    break;
            }

            return $this->hydrateResponse($httpResponse, $model);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a collection of Deposits that belong to the given Wallet.
     *
     * @param string $walletId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return DepositsPagination
     */
    public function listByWallet(string $walletId, int $page = 1, int $perPage = 20): DepositsPagination
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
                sprintf('/wallets/%s/deposits', $walletId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, DepositsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}

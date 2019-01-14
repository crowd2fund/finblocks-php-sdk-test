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
use FinBlocks\Model\KnowYourCustomer\KnowYourCustomer;
use FinBlocks\Model\Pagination\KnowYourCustomersPagination;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class KYC extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Deposits.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return KnowYourCustomersPagination
     */
    public function list(int $page = 1, int $perPage = 20): KnowYourCustomersPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/kyc', ['offset' => $offset, 'perPage' => $perPage]);

            return $this->hydrateResponse($httpResponse, KnowYourCustomersPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates a Deposit.
     *
     * @param KnowYourCustomer $kyc
     *
     * @throws FinBlocksException
     *
     * @return KnowYourCustomer
     */
    public function create(KnowYourCustomer $kyc): KnowYourCustomer
    {
        try {
            Assert::isInstanceOf(
                $kyc,
                KnowYourCustomer::class,
                sprintf('`kyc` argument must be an instance of `%s`', KnowYourCustomer::class)
            );

            $httpResponse = $this->httpPost('/kyc', $kyc->httpCreate());

            return $this->hydrateResponse($httpResponse, KnowYourCustomer::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a KYC.
     *
     * @param string $kycId
     *
     * @throws FinBlocksException
     *
     * @return KnowYourCustomer
     */
    public function show(string $kycId): KnowYourCustomer
    {
        try {
            Assert::stringNotEmpty($kycId, '`kycId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/kyc/%s', $kycId));

            return $this->hydrateResponse($httpResponse, KnowYourCustomer::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a collection of Deposits that belong to the given Wallet.
     *
     * @param string $accountHolderId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return KnowYourCustomersPagination
     */
    public function listByAccountHolder(string $accountHolderId, int $page = 1, int $perPage = 20): KnowYourCustomersPagination
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
                sprintf('/account-holders/%s/kyc', $accountHolderId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, KnowYourCustomersPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}

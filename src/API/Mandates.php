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
use FinBlocks\Model\Mandate\Mandate;
use FinBlocks\Model\Pagination\MandatesPagination;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Mandates extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Mandates.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return MandatesPagination
     */
    public function list(int $page = 1, int $perPage = 20): MandatesPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/mandates', ['offset' => $offset, 'perPage' => $perPage]);

            return $this->hydrateResponse($httpResponse, MandatesPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates a Mandate.
     *
     * @param Mandate $mandate
     *
     * @throws FinBlocksException
     *
     * @return Mandate
     */
    public function create(Mandate $mandate): Mandate
    {
        try {
            $httpResponse = $this->httpPost('/mandates', $mandate->httpCreate());

            return $this->hydrateResponse($httpResponse, Mandate::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves an Mandate.
     *
     * @param string $mandateId
     *
     * @throws FinBlocksException
     *
     * @return Mandate
     */
    public function show(string $mandateId): Mandate
    {
        try {
            Assert::stringNotEmpty($mandateId, '`mandateId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/mandates/%s', $mandateId));

            return $this->hydrateResponse($httpResponse, Mandate::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Deactivates the given Mandate ID, so the Account Holder won't be able to use it again to make Direct Debit Deposits.
     *
     * @param string $mandateId
     */
    public function deactivate(string $mandateId)
    {
        try {
            Assert::stringNotEmpty($mandateId, '`mandateId` argument must be a not empty string');

            $httpResponse = $this->httpDelete(sprintf('/mandates/%s', $mandateId));

            $this->hydrateResponse($httpResponse);
        } catch (SerializerException $exception) {
            // It worked - we cannot serialise because there's no content
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a collection of Mandates that belong to the given Account Holder.
     *
     * @param string $accountHolderId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return MandatesPagination
     */
    public function listByAccountHolder(string $accountHolderId, int $page = 1, int $perPage = 20): MandatesPagination
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
                sprintf('/account-holders/%s/mandates', $accountHolderId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, MandatesPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Gives access to the Flows, required to create Mandates.
     *
     * @return Flows
     */
    public function flows(): Flows
    {
        return new Flows($this->httpClient);
    }
}

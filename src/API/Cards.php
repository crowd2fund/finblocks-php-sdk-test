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
use FinBlocks\Model\Card\Card;
use FinBlocks\Model\Pagination\CardsPagination;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Cards extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Cards.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return CardsPagination
     */
    public function list(int $page = 1, int $perPage = 20): CardsPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/cards', ['offset' => $offset, 'perPage' => $perPage]);

            return $this->hydrateResponse($httpResponse, CardsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates a Card.
     *
     * @param Card $card
     *
     * @throws FinBlocksException
     *
     * @return Card
     */
    public function create(Card $card): Card
    {
        try {
            $httpResponse = $this->httpPost('/cards', $card->httpCreate());

            return $this->hydrateResponse($httpResponse, Card::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves an Card.
     *
     * @param string $cardId
     *
     * @throws FinBlocksException
     *
     * @return Card
     */
    public function show(string $cardId): Card
    {
        try {
            Assert::stringNotEmpty($cardId, '`cardId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/cards/%s', $cardId));

            return $this->hydrateResponse($httpResponse, Card::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Invalidates the given Card ID, so the Account Holder won't be able to use it again to make Card Deposits.
     *
     * @param string $cardId
     */
    public function deactivate(string $cardId)
    {
        try {
            Assert::stringNotEmpty($cardId, '`cardId` argument must be a not empty string');

            $httpResponse = $this->httpDelete(sprintf('/cards/%s', $cardId));

            $this->hydrateResponse($httpResponse, 'N/A');
        } catch (SerializerException $exception) {
            // It worked - we cannot serialise because there's no content
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a collection of Cards that belong to the given Account Holder.
     *
     * @param string $accountHolderId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return CardsPagination
     */
    public function listByAccountHolder(string $accountHolderId, int $page = 1, int $perPage = 20): CardsPagination
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
                sprintf('/account-holders/%s/cards', $accountHolderId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, CardsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * @return DevCards
     */
    public function devCards(): DevCards
    {
        @trigger_error('This method is just available for DEV and TEST purposes; don\'t use it on PROD server', E_USER_WARNING);

        return new DevCards($this->httpClient);
    }
}

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
use FinBlocks\Model\Document\AbstractFrontDocument;
use FinBlocks\Model\Document\DocumentDrivingLicense;
use FinBlocks\Model\Document\DocumentIdCard;
use FinBlocks\Model\Document\DocumentPassport;
use FinBlocks\Model\Pagination\DocumentsPagination;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class Documents extends AbstractHttpApi
{
    /**
     * Creates a Document.
     *
     * @param AbstractFrontDocument $document
     *
     * @throws FinBlocksException
     *
     * @return AbstractFrontDocument
     */
    public function create(AbstractFrontDocument $document): AbstractFrontDocument
    {
        try {
            $model = $endpoint = null;

            switch ($document->getType()) {
                case DocumentDrivingLicense::TYPE:
                    $model = DocumentDrivingLicense::class;
                    $endpoint = sprintf('/account-holders/%s/documents/driving-licence', $document->getAccountHolderId());
                    break;
                case DocumentIdCard::TYPE:
                    $model = DocumentIdCard::class;
                    $endpoint = sprintf('/account-holders/%s/documents/national-identity-card', $document->getAccountHolderId());
                    break;
                case DocumentPassport::TYPE:
                    $model = DocumentPassport::class;
                    $endpoint = sprintf('/account-holders/%s/documents/passport', $document->getAccountHolderId());
                    break;
            }

            $httpResponse = $this->httpPost($endpoint, $document->httpCreate());

            return $this->hydrateResponse($httpResponse, $model);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a Document.
     *
     * @param string $accountHolderId
     * @param string $documentId
     *
     * @throws FinBlocksException
     *
     * @return AbstractFrontDocument
     */
    public function show(string $accountHolderId, string $documentId): AbstractFrontDocument
    {
        try {
            Assert::stringNotEmpty($accountHolderId, '`accountHolderId` argument must be a not empty string');
            Assert::stringNotEmpty($documentId, '`documentId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/account-holders/%s/documents/%s', $accountHolderId, $documentId));

            $arrayResponse = json_decode($httpResponse->getBody(), true);
            $arrayResponse = is_array($arrayResponse) ? $arrayResponse : [];
            $arrayResponse['type'] = $arrayResponse['type'] ?? null;

            $model = null;

            switch ($arrayResponse['type']) {
                case DocumentDrivingLicense::TYPE:
                    $model = DocumentDrivingLicense::class;
                    break;
                case DocumentIdCard::TYPE:
                    $model = DocumentIdCard::class;
                    break;
                case DocumentPassport::TYPE:
                    $model = DocumentPassport::class;
                    break;
            }

            return $this->hydrateResponse($httpResponse, $model);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Retrieves a collection of Documents that belong to the given Account Holder.
     *
     * @param string $accountHolderId
     * @param int    $page
     * @param int    $perPage
     *
     * @throws FinBlocksException
     *
     * @return DocumentsPagination
     */
    public function listByAccountHolder(string $accountHolderId, int $page = 1, int $perPage = 20): DocumentsPagination
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
                sprintf('/account-holders/%s/documents', $accountHolderId),
                ['offset' => $offset, 'perPage' => $perPage]
            );

            return $this->hydrateResponse($httpResponse, DocumentsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }
}

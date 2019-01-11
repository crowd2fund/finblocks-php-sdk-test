<?php

namespace FinBlocks\API;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Document\AbstractDocument;
use FinBlocks\Model\Document\DocumentIdCard;
use FinBlocks\Model\Document\DocumentPassport;
use FinBlocks\Model\Pagination\DocumentsPagination;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class Documents extends AbstractHttpApi
{
    /**
     * Retrieves a collection of Documents.
     *
     * @param int $page
     * @param int $perPage
     *
     * @throws FinBlocksException
     *
     * @return DocumentsPagination
     */
    public function list(int $page = 1, int $perPage = 20): DocumentsPagination
    {
        try {
            Assert::integer($page, '`page` argument must be an integer');
            Assert::greaterThanEq($page, 1, '`page` argument must be greater than or equal to 1');

            Assert::integer($perPage, '`perPage` argument must be an integer');
            Assert::greaterThanEq($perPage, 1, '`perPage` argument must be greater than or equal to 1');
            Assert::lessThanEq($perPage, 100, '`perPage` argument must be less than or equal to 100');

            $offset = (($page - 1) * $perPage);

            $httpResponse = $this->httpGet('/documents', ['offset' => $offset, 'perPage' => $perPage]);

            return $this->hydrateResponse($httpResponse, DocumentsPagination::class);
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * Creates a Document.
     *
     * @param AbstractDocument $document
     *
     * @throws FinBlocksException
     *
     * @return AbstractDocument
     */
    public function create(AbstractDocument $document): AbstractDocument {
        try {
            $model = $endpoint = null;

            switch ($document->getType()) {
                case DocumentIdCard::TYPE:
                    $model = DocumentIdCard::class;
                    $endpoint = '/documents/id-card';
                    break;
                case DocumentPassport::TYPE:
                    $model = DocumentPassport::class;
                    $endpoint = '/documents/passport';
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
     * @param string $documentId
     *
     * @throws FinBlocksException
     *
     * @return AbstractDocument
     */
    public function show(string $documentId): AbstractDocument
    {
        try {
            Assert::stringNotEmpty($documentId, '`documentId` argument must be a not empty string');

            $httpResponse = $this->httpGet(sprintf('/documents/%s', $documentId));

            $arrayResponse = json_decode($httpResponse->getBody(), true);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \RuntimeException(json_last_error_msg(), json_last_error());
            }

            $arrayResponse['type'] = $arrayResponse['type'] ?? null;

            $model = null;

            switch ($arrayResponse['type']) {
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

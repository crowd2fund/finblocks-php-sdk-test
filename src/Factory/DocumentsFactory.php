<?php

namespace FinBlocks\Factory;

use FinBlocks\Model\Document\DocumentIdCard;
use FinBlocks\Model\Document\DocumentPassport;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class DocumentsFactory
{
    /**
     * Creates a new Model.
     *
     * @return DocumentIdCard
     */
    public function createIdCard(): DocumentIdCard
    {
        return DocumentIdCard::create();
    }
    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return DocumentIdCard
     */
    public function createIdCardFromPayload(string $jsonData): DocumentIdCard
    {
        return DocumentIdCard::createFromPayload($jsonData);
    }

    /**
     * Creates a new Model.
     *
     * @return DocumentPassport
     */
    public function createPassport(): DocumentPassport
    {
        return DocumentPassport::create();
    }
    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return DocumentPassport
     */
    public function createPassportFromPayload(string $jsonData): DocumentPassport
    {
        return DocumentPassport::createFromPayload($jsonData);
    }
}

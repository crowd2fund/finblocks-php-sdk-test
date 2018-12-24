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
     * Creates a new ID Card Document's Model.
     *
     * @return DocumentIdCard
     */
    public function createIdCard(): DocumentIdCard
    {
        return new DocumentIdCard();
    }

    /**
     * Creates a new Passport Document's Model.
     *
     * @return DocumentPassport
     */
    public function createPassport(): DocumentPassport
    {
        return new DocumentPassport();
    }
}

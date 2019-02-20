<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Factory;

use FinBlocks\Model\Document\DocumentDrivingLicense;
use FinBlocks\Model\Document\DocumentIdCard;
use FinBlocks\Model\Document\DocumentPassport;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class DocumentsFactory
{
    /**
     * Creates a new Model.
     *
     * @return DocumentDrivingLicense
     */
    public function createDrivingLicense(): DocumentDrivingLicense
    {
        return DocumentDrivingLicense::create();
    }

    /**
     * Creates a new Model filling their properties with the JSON payload.
     *
     * @param string $jsonData
     *
     * @return DocumentDrivingLicense
     */
    public function createDrivingLicenseFromPayload(string $jsonData): DocumentDrivingLicense
    {
        return DocumentDrivingLicense::createFromPayload($jsonData);
    }

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

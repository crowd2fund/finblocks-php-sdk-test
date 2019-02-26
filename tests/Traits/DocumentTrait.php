<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\Traits;

use FinBlocks\FinBlocks;
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
trait DocumentTrait
{
    public function traitCreateDocumentDrivingLicenseModel(FinBlocks $finBlocks, string $accountHolderId): DocumentDrivingLicense
    {
        $file = base64_encode(file_get_contents(sprintf('%s/../Resources/finblocks-logo-small.png', __DIR__)));

        $model = $finBlocks->factories()->documents()->createDrivingLicense();

        $model->setAccountHolderId($accountHolderId);
        $model->setLabel('Label for Driving License\'s Document');
        $model->setTag('Tag for Driving License\'s Document');
        $model->setFront($file);
        $model->setBack($file);

        return $model;
    }

    public function traitCreateDocumentIdCardModel(FinBlocks $finBlocks, string $accountHolderId): DocumentIdCard
    {
        $file = base64_encode(file_get_contents(sprintf('%s/../Resources/finblocks-logo-small.png', __DIR__)));

        $model = $finBlocks->factories()->documents()->createIdCard();

        $model->setAccountHolderId($accountHolderId);
        $model->setLabel('Label for ID Card\'s Document');
        $model->setTag('Tag for ID Card\'s Document');
        $model->setFront($file);
        $model->setBack($file);

        return $model;
    }

    public function traitCreateDocumentPassportModel(FinBlocks $finBlocks, string $accountHolderId): DocumentPassport
    {
        $file = base64_encode(file_get_contents(sprintf('%s/../Resources/finblocks-logo-small.png', __DIR__)));

        $model = $finBlocks->factories()->documents()->createPassport();

        $model->setAccountHolderId($accountHolderId);
        $model->setLabel('Label for Passport\'s Document');
        $model->setTag('Tag for Passport\'s Document');
        $model->setFront($file);

        return $model;
    }
}

<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\IntegrationTests\API;

use FinBlocks\Client\HttpResponse;
use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Document\DocumentDrivingLicense;
use FinBlocks\Model\Document\DocumentIdCard;
use FinBlocks\Model\Document\DocumentPassport;
use FinBlocks\Model\Pagination\DocumentsPagination;
use FinBlocks\Tests\Traits\AccountHolderTrait;
use FinBlocks\Tests\Traits\DocumentTrait;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class DocumentsTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use DocumentTrait;

    public function testCreateDocumentDrivingLicense()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $document = $this->traitCreateDocumentDrivingLicenseModel($this->finBlocks, $accountHolder->getId());
        $document = $this->finBlocks->api()->documents()->create($document);

        $this->assertNotEmpty($document->getId());
        $this->assertEquals('Label for Driving License\'s Document', $document->getLabel());
        $this->assertEquals('Tag for Driving License\'s Document', $document->gettag());
        $this->assertEquals(DocumentDrivingLicense::TYPE, $document->getType());
        $this->assertInstanceOf(\DateTime::class, $document->getCreatedAt());

        $reloadedDocument = $this->finBlocks->api()->documents()->show($accountHolder->getId(), $document->getId());

        $this->assertEquals($document->getId(), $reloadedDocument->getId());
    }

    public function testCreateDocumentIdCard()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $document = $this->traitCreateDocumentIdCardModel($this->finBlocks, $accountHolder->getId());
        $document = $this->finBlocks->api()->documents()->create($document);

        $this->assertNotEmpty($document->getId());
        $this->assertEquals('Label for ID Card\'s Document', $document->getLabel());
        $this->assertEquals('Tag for ID Card\'s Document', $document->gettag());
        $this->assertEquals(DocumentIdCard::TYPE, $document->getType());
        $this->assertInstanceOf(\DateTime::class, $document->getCreatedAt());

        $reloadedDocument = $this->finBlocks->api()->documents()->show($accountHolder->getId(), $document->getId());

        $this->assertEquals($document->getId(), $reloadedDocument->getId());
    }

    public function testCreateDocumentPassport()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $document = $this->traitCreateDocumentPassportModel($this->finBlocks, $accountHolder->getId());
        $document = $this->finBlocks->api()->documents()->create($document);

        $this->assertNotEmpty($document->getId());
        $this->assertEquals('Label for Passport\'s Document', $document->getLabel());
        $this->assertEquals('Tag for Passport\'s Document', $document->gettag());
        $this->assertEquals(DocumentPassport::TYPE, $document->getType());
        $this->assertInstanceOf(\DateTime::class, $document->getCreatedAt());

        $reloadedDocument = $this->finBlocks->api()->documents()->show($accountHolder->getId(), $document->getId());

        $this->assertEquals($document->getId(), $reloadedDocument->getId());
    }

    public function testCreateEmptyDocument()
    {
        $document = $this->finBlocks->factories()->documents()->createPassport();
        $document->setAccountHolderId('invalid-account-holder-id');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->documents()->create($document);
    }

    public function testRetrieveDocumentThatBelongsToAnotherAccountHolder()
    {
        $accountHolder1 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($accountHolder1);

        $accountHolder2 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($accountHolder2);

        $document2 = $this->traitCreateDocumentPassportModel($this->finBlocks, $accountHolder2->getId());
        $document2 = $this->finBlocks->api()->documents()->create($document2);

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->documents()->show($accountHolder1->getId(), $document2->getId());
    }

    public function testListAllByAccountHolder()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder1 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($accountHolder1);

        $documentIdCard = $this->traitCreateDocumentIdCardModel($this->finBlocks, $accountHolder1->getId());
        $this->finBlocks->api()->documents()->create($documentIdCard);

        $accountHolder2 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($accountHolder2);

        $documentPassport = $this->traitCreateDocumentPassportModel($this->finBlocks, $accountHolder2->getId());
        $this->finBlocks->api()->documents()->create($documentPassport);

        $returnedContent = $this->finBlocks->api()->documents()->listByAccountHolder($accountHolder1->getId());

        $this->assertInstanceOf(DocumentsPagination::class, $returnedContent);
        $this->assertEquals(1, $returnedContent->getTotal());
    }

    public function testGetPaginatedKycChecksForGivenAccountHolderWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->documents()->listByAccountHolder('account-holder-id', -1);
    }

    public function testGetPaginatedKycChecksForGivenAccountHolderWithInvalidPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->documents()->listByAccountHolder('account-holder-id', 1, 10000);
    }
}

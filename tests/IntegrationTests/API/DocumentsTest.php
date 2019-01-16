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

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Document\AbstractDocument;
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

    public function testCreateDocumentIdCard()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $document = $this->traitCreateDocumentIdCardModel($this->finBlocks, $accountHolder->getId());
        $document = $this->finBlocks->api()->documents()->create($document);

        $this->assertNotEmpty($document->getId());
        $this->assertEquals($accountHolder->getId(), $document->getAccountHolderId());
        $this->assertEquals('Label for ID Card\'s Document', $document->getLabel());
        $this->assertEquals('Tag for ID Card\'s Document', $document->gettag());
        $this->assertEquals('idCard', $document->getType());
        $this->assertInstanceOf(\DateTime::class, $document->getCreatedAt());

        $reloadedDocument = $this->finBlocks->api()->accountHolders()->show($document->getId());

        $this->assertEquals($document->getId(), $reloadedDocument->getId());
    }

    public function testCreateDocumentPassport()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $document = $this->traitCreateDocumentPassportModel($this->finBlocks, $accountHolder->getId());
        $document = $this->finBlocks->api()->documents()->create($document);

        $this->assertNotEmpty($document->getId());
        $this->assertEquals($accountHolder->getId(), $document->getAccountHolderId());
        $this->assertEquals('Label for ID Card\'s Document', $document->getLabel());
        $this->assertEquals('Tag for ID Card\'s Document', $document->gettag());
        $this->assertEquals('passport', $document->getType());
        $this->assertInstanceOf(\DateTime::class, $document->getCreatedAt());

        $reloadedDocument = $this->finBlocks->api()->accountHolders()->show($document->getId());

        $this->assertEquals($document->getId(), $reloadedDocument->getId());
    }

    public function testListAll()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $documentIdCard = $this->traitCreateDocumentIdCardModel($this->finBlocks, $accountHolder->getId());
        $this->finBlocks->api()->documents()->create($documentIdCard);

        $documentPassport = $this->traitCreateDocumentPassportModel($this->finBlocks, $accountHolder->getId());
        $this->finBlocks->api()->documents()->create($documentPassport);

        $returnedContent = $this->finBlocks->api()->documents()->list(1, 2);

        $this->assertInstanceOf(DocumentsPagination::class, $returnedContent);
        $this->assertGreaterThanOrEqual(2, count($returnedContent->getItems()));

        foreach ($returnedContent->getItems() as $document) {
            $this->assertInstanceOf(AbstractDocument::class, $document);
        }
    }

    public function testListAllWrongPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->documents()->list(-1);
    }

    public function testListAllWrongPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->documents()->list(1, 10000);
    }

    public function testListAllByAccountHolder()
    {
        $this->markTestIncomplete('Not yet implemented');

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

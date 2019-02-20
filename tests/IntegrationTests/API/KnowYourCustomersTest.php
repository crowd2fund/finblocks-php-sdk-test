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
use FinBlocks\Model\KnowYourCustomer\KnowYourCustomer;
use FinBlocks\Model\Pagination\KnowYourCustomersPagination;
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
class KnowYourCustomersTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use DocumentTrait;

    public function testSendDocumentForAdvancedKycCheck()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $document = $this->traitCreateDocumentPassportModel($this->finBlocks, $accountHolder->getId());
        $document = $this->finBlocks->api()->documents()->create($document);

        $kyc = $this->finBlocks->factories()->kyc()->create();
        $kyc->setDocumentId($document->getId());
        $kyc->setLabel('KYC Label');
        $kyc->setTag('KYC Tag');

        $returnedKyc = $this->finBlocks->api()->kyc()->create($accountHolder->getId(), $kyc);

        $this->assertInstanceOf(KnowYourCustomer::class, $returnedKyc);
        $this->assertInstanceOf(\DateTime::class, $returnedKyc->getCreatedAt());

        $this->assertNotEmpty('string', $returnedKyc->getId());

        $this->assertEquals(null, $returnedKyc->getRefusedReason());
        $this->assertEquals(null, $returnedKyc->getProcessedAt());

        $this->assertEquals($document->getId(), $returnedKyc->getDocumentId());
        $this->assertEquals('KYC Label', $returnedKyc->getLabel());
        $this->assertEquals('KYC Tag', $returnedKyc->getTag());
        $this->assertEquals(KnowYourCustomer::STATUS_SUCCEEDED, $returnedKyc->getStatus());

        $reloadedKyc = $this->finBlocks->api()->kyc()->show($accountHolder->getId(), $returnedKyc->getId());

        $this->assertEquals($returnedKyc->getId(), $reloadedKyc->getId());
        $this->assertEquals($returnedKyc->getDocumentId(), $reloadedKyc->getDocumentId());
        $this->assertEquals($returnedKyc->getLabel(), $reloadedKyc->getLabel());
        $this->assertEquals($returnedKyc->getTag(), $reloadedKyc->getTag());
        $this->assertEquals($returnedKyc->getCreatedAt()->format('YmdHis'), $reloadedKyc->getCreatedAt()->format('YmdHis'));
    }

    public function testIncompleteKycRequest()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $kyc = $this->finBlocks->factories()->kyc()->create();

        $this->finBlocks->api()->kyc()->create($accountHolder->getId(), $kyc);
    }

    public function testRetrieveNonExistingKyc()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->kyc()->show($accountHolder->getId(), 'non-existing-id');
    }

    public function testGetPaginatedKycChecksForGivenAccountHolder()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $document = $this->traitCreateDocumentIdCardModel($this->finBlocks, $accountHolder->getId());
        $document = $this->finBlocks->api()->documents()->create($document);

        $kyc = $this->finBlocks->factories()->kyc()->create();
        $kyc->setDocumentId($document->getId());
        $kyc = $this->finBlocks->api()->kyc()->create($accountHolder->getId(), $kyc);

        $returnedContent = $this->finBlocks->api()->kyc()->listByAccountHolder($accountHolder->getId());

        $this->assertInstanceOf(KnowYourCustomersPagination::class, $returnedContent);
        $this->assertEquals(1, $returnedContent->getTotal());
        $this->assertInternalType('array', $returnedContent->getItems());
        $this->assertInstanceOf(KnowYourCustomer::class, $returnedContent->getItems()[0]);
        $this->assertEquals($kyc->getId(), $returnedContent->getItems()[0]->getId());
    }

    public function testGetPaginatedKycChecksForGivenAccountHolderWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->kyc()->listByAccountHolder('account-holder-id', -1);
    }

    public function testGetPaginatedKycChecksForGivenAccountHolderWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->kyc()->listByAccountHolder('account-holder-id', 1, -1);
    }

    public function testGetPaginatedKycChecksForGivenAccountHolderWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->kyc()->listByAccountHolder('account-holder-id', 1, 10000);
    }
}

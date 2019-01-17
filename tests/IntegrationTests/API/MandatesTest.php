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
use FinBlocks\Model\Mandate\Mandate;
use FinBlocks\Model\Pagination\MandatesPagination;
use FinBlocks\Tests\Traits\AccountHolderTrait;
use FinBlocks\Tests\Traits\BankAccountTrait;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class MandatesTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use BankAccountTrait;

    public function testCreateMandateForGbBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $mandate = $this->finBlocks->factories()->mandates()->create();
        $mandate->setBankAccountId($bankAccount->getId());
        $mandate->setReturnUrl('https://domain.com/return/mandate');
        $mandate->setLabel('Mandate Label');
        $mandate->setTag('Mandate Tag');

        $returnedMandate = $this->finBlocks->api()->mandates()->create($mandate);

        $this->assertInstanceOf(Mandate::class, $returnedMandate);
        $this->assertInstanceOf(\DateTime::class, $returnedMandate->getCreatedAt());

        $this->assertNotEmpty($returnedMandate->getId());
        $this->assertNotEmpty($returnedMandate->getDocumentUrl());
        $this->assertNotEmpty($returnedMandate->getScheme());
        $this->assertNotEmpty($returnedMandate->getBankReference());

        $this->assertEquals($bankAccount->getId(), $returnedMandate->getBankAccountId());
        $this->assertEquals($accountHolder->getId(), $returnedMandate->getAccountHolderId());

        $this->assertEquals('Mandate Label', $returnedMandate->getLabel());
        $this->assertEquals('Mandate Tag', $returnedMandate->getTag());
        $this->assertEquals('created', $returnedMandate->getStatus());

        $this->assertTrue(in_array(strtoupper($returnedMandate->getScheme()), ['SEPA', 'BACS']));

        $reloadedMandate = $this->finBlocks->api()->mandates()->show($returnedMandate->getId());

        $this->assertEquals($returnedMandate->getId(), $reloadedMandate->getId());
    }

    public function testCreateMandateForIbanBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountIbanModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $mandate = $this->finBlocks->factories()->mandates()->create();
        $mandate->setBankAccountId($bankAccount->getId());
        $mandate->setReturnUrl('https://domain.com/return/mandate');
        $mandate->setLabel('Mandate Label');
        $mandate->setTag('Mandate Tag');

        $returnedMandate = $this->finBlocks->api()->mandates()->create($mandate);

        $this->assertInstanceOf(Mandate::class, $returnedMandate);
        $this->assertInstanceOf(\DateTime::class, $returnedMandate->getCreatedAt());

        $this->assertNotEmpty($returnedMandate->getId());
        $this->assertNotEmpty($returnedMandate->getDocumentUrl());
        $this->assertNotEmpty($returnedMandate->getScheme());
        $this->assertNotEmpty($returnedMandate->getBankReference());

        $this->assertEquals($bankAccount->getId(), $returnedMandate->getBankAccountId());
        $this->assertEquals($accountHolder->getId(), $returnedMandate->getAccountHolderId());

        $this->assertEquals('Mandate Label', $returnedMandate->getLabel());
        $this->assertEquals('Mandate Tag', $returnedMandate->getTag());
        $this->assertEquals('created', $returnedMandate->getStatus());

        $this->assertTrue(in_array(strtoupper($returnedMandate->getScheme()), ['SEPA', 'BACS']));

        $reloadedMandate = $this->finBlocks->api()->mandates()->show($returnedMandate->getId());

        $this->assertEquals($returnedMandate->getId(), $reloadedMandate->getId());
    }

    public function testCreateMandateForCaBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountCaModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $mandate = $this->finBlocks->factories()->mandates()->create();
        $mandate->setBankAccountId($bankAccount->getId());
        $mandate->setReturnUrl('https://domain.com/return/mandate');

        $this->finBlocks->api()->mandates()->create($mandate);
    }

    public function testCreateMandateForUsBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountUsModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $mandate = $this->finBlocks->factories()->mandates()->create();
        $mandate->setBankAccountId($bankAccount->getId());
        $mandate->setReturnUrl('https://domain.com/return/mandate');

        $this->finBlocks->api()->mandates()->create($mandate);
    }

    public function testCreateMandateForOtherBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountOtherModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $mandate = $this->finBlocks->factories()->mandates()->create();
        $mandate->setBankAccountId($bankAccount->getId());
        $mandate->setReturnUrl('https://domain.com/return/mandate');

        $this->finBlocks->api()->mandates()->create($mandate);
    }

    public function testGetPaginatedMandates()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $mandate = $this->finBlocks->factories()->mandates()->create();
        $mandate->setBankAccountId($bankAccount->getId());
        $mandate->setReturnUrl('https://domain.com/return/mandate');
        $mandate = $this->finBlocks->api()->mandates()->create($mandate);

        $this->assertNotEmpty($mandate->getId());

        $paginatedContent = $this->finBlocks->api()->mandates()->list(1, 1);

        $this->assertInstanceOf(MandatesPagination::class, $paginatedContent);
        $this->assertGreaterThanOrEqual(1, $paginatedContent->getTotal());
        $this->assertInternalType('array', $paginatedContent->getItems());
        $this->assertCount(1, $paginatedContent->getItems());
        $this->assertInstanceOf(Mandate::class, $paginatedContent->getItems()[0]);
    }

    public function testGetPaginatedMandatesWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->mandates()->list(-1);
    }

    public function testGetPaginatedMandatesWithInvalidPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->mandates()->list(1, -1);
    }

    public function testDeactivateMandate()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $mandate = $this->finBlocks->factories()->mandates()->create();
        $mandate->setBankAccountId($bankAccount->getId());
        $mandate->setReturnUrl('https://domain.com/return/mandate');
        $mandate = $this->finBlocks->api()->mandates()->create($mandate);
        $this->assertNotEmpty($mandate->getId());

        $this->finBlocks->api()->mandates()->deactivate($mandate->getId());
        $deactivatedMandate = $this->finBlocks->api()->mandates()->show($mandate->getId());
        $this->assertNotEmpty($deactivatedMandate->getId());

        $this->expectException(FinBlocksException::class);
        $this->finBlocks->api()->mandates()->show($mandate->getId());
    }

    public function testDeactivateNonExistingMandate()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->mandates()->show('mandate-id');
    }

    public function testGetPaginatedMandatesByAccountHolder()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder1 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($accountHolder1);

        $bankAccount1 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder1->getId());
        $bankAccount1 = $this->finBlocks->api()->bankAccounts()->create($bankAccount1);

        $mandate1 = $this->finBlocks->factories()->mandates()->create();
        $mandate1->setBankAccountId($bankAccount1->getId());
        $mandate1->setReturnUrl('https://domain.com/return/mandate');
        $mandate1 = $this->finBlocks->api()->mandates()->create($mandate1);
        $this->assertNotEmpty($mandate1->getId());

        $mandate2 = $this->finBlocks->factories()->mandates()->create();
        $mandate2->setBankAccountId($bankAccount1->getId());
        $mandate2->setReturnUrl('https://domain.com/return/mandate');
        $mandate2 = $this->finBlocks->api()->mandates()->create($mandate2);
        $this->assertNotEmpty($mandate2->getId());

        $accountHolder2 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($accountHolder2);

        $bankAccount2 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder2->getId());
        $bankAccount2 = $this->finBlocks->api()->bankAccounts()->create($bankAccount2);

        $mandate3 = $this->finBlocks->factories()->mandates()->create();
        $mandate3->setBankAccountId($bankAccount2->getId());
        $mandate3->setReturnUrl('https://domain.com/return/mandate');
        $mandate3 = $this->finBlocks->api()->mandates()->create($mandate3);
        $this->assertNotEmpty($mandate3->getId());

        $paginatedContent = $this->finBlocks->api()->mandates()->listByAccountHolder($accountHolder1->getId(), 1, 1);

        $this->assertInstanceOf(MandatesPagination::class, $paginatedContent);
        $this->assertEquals(2, $paginatedContent->getTotal());
        $this->assertInternalType('array', $paginatedContent->getItems());
        $this->assertCount(1, $paginatedContent->getItems());
        $this->assertInstanceOf(Mandate::class, $paginatedContent->getItems()[0]);
    }

    public function testGetPaginatedMandatesByAccountHolderWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->mandates()->listByAccountHolder('account-holder-id', -1);
    }

    public function testGetPaginatedMandatesByAccountHolderWithInvalidPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->mandates()->listByAccountHolder('account-holder-id', 1, 10000);
    }
}

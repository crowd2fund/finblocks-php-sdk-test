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
use FinBlocks\Model\BankAccount\AbstractBankAccount;
use FinBlocks\Model\BankAccount\BankAccountCa;
use FinBlocks\Model\BankAccount\BankAccountGb;
use FinBlocks\Model\BankAccount\BankAccountIban;
use FinBlocks\Model\BankAccount\BankAccountOther;
use FinBlocks\Model\BankAccount\BankAccountUs;
use FinBlocks\Model\Pagination\BankAccountsPagination;
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
class BankAccountsTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use BankAccountTrait;

    public function testCreateGbBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountGb::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertEquals(BankAccountGb::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('GB Bank Account Label', $bankAccount->getLabel());
        $this->assertEquals('GB Bank Account Tag', $bankAccount->getTag());
        $this->assertEquals('000000', $bankAccount->getDetails()->getSortCode());
        $this->assertEquals('00000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateGbBankAccountWithJustTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountGb::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertNull($bankAccount->getLabel());
        $this->assertNull($bankAccount->getTag());

        $this->assertEquals(BankAccountGb::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('000000', $bankAccount->getDetails()->getSortCode());
        $this->assertEquals('00000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateGbBankAccountWithoutTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $bankAccount = $this->finBlocks->factories()->bankAccounts()->createGb();

        $this->finBlocks->api()->bankAccounts()->create($bankAccount);
    }

    public function testCreateIbanBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountIbanModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountIban::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertEquals(BankAccountIban::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('IBAN Bank Account Label', $bankAccount->getLabel());
        $this->assertEquals('IBAN Bank Account Tag', $bankAccount->getTag());
        $this->assertEquals('00000000', $bankAccount->getDetails()->getBic());
        $this->assertEquals('00000000000000000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateIbanBankAccountWithJustTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountIbanModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountIban::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertNull($bankAccount->getLabel());
        $this->assertNull($bankAccount->getTag());
        $this->assertNull($bankAccount->getDetails()->getBic());

        $this->assertEquals(BankAccountIban::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('00000000000000000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateIbanBankAccountWithoutTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $bankAccount = $this->finBlocks->factories()->bankAccounts()->createIban();

        $this->finBlocks->api()->bankAccounts()->create($bankAccount);
    }

    public function testCreateCaBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountCaModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountCa::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertEquals(BankAccountCa::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('CA Bank Account Label', $bankAccount->getLabel());
        $this->assertEquals('CA Bank Account Tag', $bankAccount->getTag());
        $this->assertEquals('Bank name', $bankAccount->getDetails()->getBankName());
        $this->assertEquals('Code', $bankAccount->getDetails()->getBranchCode());
        $this->assertEquals('000', $bankAccount->getDetails()->getInstitutionNumber());
        $this->assertEquals('00000000000000000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateCaBankAccountWithJustTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountCaModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountCa::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertNull($bankAccount->getLabel());
        $this->assertNull($bankAccount->getTag());

        $this->assertEquals(BankAccountCa::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('Bank name', $bankAccount->getDetails()->getBankName());
        $this->assertEquals('Code', $bankAccount->getDetails()->getBranchCode());
        $this->assertEquals('000', $bankAccount->getDetails()->getInstitutionNumber());
        $this->assertEquals('00000000000000000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateCaBankAccountWithoutTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $bankAccount = $this->finBlocks->factories()->bankAccounts()->createCa();

        $this->finBlocks->api()->bankAccounts()->create($bankAccount);
    }

    public function testCreateUsBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountUsModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountUs::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertEquals(BankAccountUs::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('US Bank Account Label', $bankAccount->getLabel());
        $this->assertEquals('US Bank Account Tag', $bankAccount->getTag());
        $this->assertEquals('000000000', $bankAccount->getDetails()->getAba());
        $this->assertEquals('00000000000000000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateUsBankAccountWithJustTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountUsModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountUs::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertNull($bankAccount->getLabel());
        $this->assertNull($bankAccount->getTag());

        $this->assertEquals(BankAccountUs::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('000000000', $bankAccount->getDetails()->getAba());
        $this->assertEquals('00000000000000000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateUsBankAccountWithoutTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $bankAccount = $this->finBlocks->factories()->bankAccounts()->createUs();

        $this->finBlocks->api()->bankAccounts()->create($bankAccount);
    }

    public function testCreateOtherBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountOtherModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountOther::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertEquals(BankAccountOther::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('OTHER Bank Account Label', $bankAccount->getLabel());
        $this->assertEquals('OTHER Bank Account Tag', $bankAccount->getTag());
        $this->assertEquals('GBR', $bankAccount->getDetails()->getCountry());
        $this->assertEquals('00000000', $bankAccount->getDetails()->getBic());
        $this->assertEquals('00000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateOtherBankAccountWithJustTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountOtherModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountOther::class, $bankAccount);
        $this->assertInstanceOf(\DateTime::class, $bankAccount->getCreatedAt());

        $this->assertNotEmpty($bankAccount->getId());

        $this->assertNull($bankAccount->getLabel());
        $this->assertNull($bankAccount->getTag());

        $this->assertEquals(BankAccountOther::TYPE, $bankAccount->getType());
        $this->assertEquals($accountHolder->getId(), $bankAccount->getAccountHolderId());
        $this->assertEquals('GBR', $bankAccount->getDetails()->getCountry());
        $this->assertEquals('00000000', $bankAccount->getDetails()->getBic());
        $this->assertEquals('00000000', $bankAccount->getDetails()->getAccountNumber());
    }

    public function testCreateOtherBankAccountWithoutTheRequiredFields()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $bankAccount = $this->finBlocks->factories()->bankAccounts()->createOther();

        $this->finBlocks->api()->bankAccounts()->create($bankAccount);
    }

    public function testRetrieveNonExistingBankAccount()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->bankAccounts()->show('bank-account-id');
    }

    public function testRetrievePaginatedBankAccounts()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $returnedContent = $this->finBlocks->api()->bankAccounts()->list(1, 1);

        $this->assertInstanceOf(BankAccountsPagination::class, $returnedContent);
        $this->assertGreaterThanOrEqual(1, $returnedContent->getTotal());
        $this->assertInternalType('array', $returnedContent->getEmbedded());
        $this->assertCount(1, $returnedContent->getEmbedded());
        $this->assertInstanceOf(AbstractBankAccount::class, $returnedContent->getEmbedded()[0]);
    }

    public function testRetrievePaginatedBankAccountsWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->bankAccounts()->list(-1);
    }

    public function testRetrievePaginatedBankAccountsWithInvalidPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->bankAccounts()->list(1, 10000);
    }

    public function testDeactivateBankAccount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $this->assertInstanceOf(BankAccountGb::class, $bankAccount);
        $this->assertEquals(true, $bankAccount->isActive());

        $this->finBlocks->api()->bankAccounts()->deactivate($bankAccount->getId());

        $reloadedBankAccount = $this->finBlocks->api()->bankAccounts()->show($bankAccount->getId());

        $this->assertInstanceOf(BankAccountGb::class, $reloadedBankAccount);
        $this->assertEquals($bankAccount->getId(), $reloadedBankAccount->getId());
        $this->assertEquals(false, $reloadedBankAccount->isActive());

        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->bankAccounts()->show($bankAccount->getId());
    }

    public function testDeactivateNonExistingBankAccount()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->bankAccounts()->deactivate('bank-account-id');
    }

    public function testRetrievePaginatedBankAccountsForTheGivenAccountHolder()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder1 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($accountHolder1);

        $accountHolder2 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($accountHolder2);

        $bankAccount1 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder1->getId());
        $bankAccount1 = $this->finBlocks->api()->bankAccounts()->create($bankAccount1);

        $bankAccount2 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder1->getId());
        $this->finBlocks->api()->bankAccounts()->create($bankAccount2);

        $bankAccount3 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder2->getId());
        $this->finBlocks->api()->bankAccounts()->create($bankAccount3);

        $returnedContent = $this->finBlocks->api()->bankAccounts()->listByAccountHolder($accountHolder1->getId(), 1, 1);

        $this->assertInstanceOf(BankAccountsPagination::class, $returnedContent);
        $this->assertEquals(2, $returnedContent->getTotal());
        $this->assertInternalType('array', $returnedContent->getEmbedded());
        $this->assertCount(1, $returnedContent->getEmbedded());
        $this->assertInstanceOf(AbstractBankAccount::class, $returnedContent->getEmbedded()[0]);
        $this->assertEquals($bankAccount1->getId(), $returnedContent->getEmbedded()[0]->getId());
    }

    public function testRetrievePaginatedBankAccountsForTheGivenAccountHolderWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->bankAccounts()->listByAccountHolder('account-holder-id', -1);
    }

    public function testRetrievePaginatedBankAccountsForTheGivenAccountHolderWithInvalidPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->bankAccounts()->listByAccountHolder('account-holder-id', 1, 10000);
    }
}

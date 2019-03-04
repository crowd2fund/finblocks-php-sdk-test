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
use FinBlocks\Model\AccountHolder\AbstractAccountHolder;
use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;
use FinBlocks\Model\AccountHolder\Company\Company;
use FinBlocks\Model\Address\Address;
use FinBlocks\Model\Pagination\AccountHoldersPagination;
use FinBlocks\Tests\Traits\AccountHolderTrait;
use Nyholm\NSA;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class AccountHoldersTest extends AbstractApiTests
{
    use AccountHolderTrait;

    public function testCreateAccountHolderIndividual()
    {
        $model = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);

        $returnedContent = $this->finBlocks->api()->accountHolders()->create($model);

        $this->assertInstanceOf(AccountHolderIndividual::class, $returnedContent);
        $this->assertInstanceOf(Address::class, $returnedContent->getAddress());

        $this->assertNotEmpty('string', $returnedContent->getId());

        $this->assertEquals(AccountHolderIndividual::TYPE, $returnedContent->getType());
        $this->assertEquals('individual@johnpublic.com', $returnedContent->getEmail());
        $this->assertEquals('John Q. Public', $returnedContent->getLabel());
        $this->assertEquals('Individual Test User', $returnedContent->getTag());
        $this->assertEquals('John', $returnedContent->getGivenName());
        $this->assertEquals('Q.', $returnedContent->getMiddleName());
        $this->assertEquals('Public', $returnedContent->getFamilyName());
        $this->assertEquals('1985-04-23', $returnedContent->getDateOfBirth()->format('Y-m-d'));
        $this->assertEquals('GBR', $returnedContent->getNationality());
        $this->assertEquals('Unknown', $returnedContent->getOccupation());
        $this->assertEquals(6, $returnedContent->getIncomeRange());
        $this->assertTrue(in_array($returnedContent->getKyc(), [AbstractAccountHolder::KYC_STATUS_NONE, AbstractAccountHolder::KYC_STATUS_PENDING]));
        $this->assertNull($returnedContent->getImportedKycStatus());

        $this->assertEquals('3', $returnedContent->getAddress()->getFlatNumber());
        $this->assertEquals('28', $returnedContent->getAddress()->getBuildingNumber());
        $this->assertEquals('n/a', $returnedContent->getAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $returnedContent->getAddress()->getStreet());
        $this->assertEquals('N/A', $returnedContent->getAddress()->getSubStreet());
        $this->assertEquals('London', $returnedContent->getAddress()->getTown());
        $this->assertEquals('England', $returnedContent->getAddress()->getState());
        $this->assertEquals('EC1N 6TD', $returnedContent->getAddress()->getPostcode());
        $this->assertEquals('GBR', $returnedContent->getAddress()->getCountry());

        $reloadedContent = $this->finBlocks->api()->accountHolders()->show($returnedContent->getId());

        $this->assertTrue(in_array($reloadedContent->getKyc(), [AbstractAccountHolder::KYC_STATUS_NONE, AbstractAccountHolder::KYC_STATUS_PENDING, AbstractAccountHolder::KYC_STATUS_BASIC]));
    }

    public function testCreateAccountHolderBusiness()
    {
        $model = $this->traitCreateAccountHolderBusinessModel($this->finBlocks);
        $model->setImportedKycStatus(AbstractAccountHolder::KYC_STATUS_ADVANCED);

        $returnedContent = $this->finBlocks->api()->accountHolders()->create($model);

        $this->assertInstanceOf(AccountHolderBusiness::class, $returnedContent);
        $this->assertInstanceOf(Address::class, $returnedContent->getAddress());
        $this->assertInstanceOf(Company::class, $returnedContent->getCompany());
        $this->assertInstanceOf(Address::class, $returnedContent->getCompany()->getAddress());

        $this->assertNotEmpty('string', $returnedContent->getId());

        $this->assertEquals(AccountHolderBusiness::TYPE, $returnedContent->getType());
        $this->assertEquals('business@johnpublic.com', $returnedContent->getEmail());
        $this->assertEquals('John Q. Public', $returnedContent->getLabel());
        $this->assertEquals('Business Test User', $returnedContent->getTag());
        $this->assertEquals('John', $returnedContent->getGivenName());
        $this->assertEquals('Q.', $returnedContent->getMiddleName());
        $this->assertEquals('Public', $returnedContent->getFamilyName());
        $this->assertEquals('1985-04-23', $returnedContent->getDateOfBirth()->format('Y-m-d'));
        $this->assertEquals('GBR', $returnedContent->getNationality());
        $this->assertEquals('CEO', $returnedContent->getOccupation());
        $this->assertEquals(6, $returnedContent->getIncomeRange());
        $this->assertEquals(AbstractAccountHolder::KYC_STATUS_ADVANCED, $returnedContent->getKyc());
        $this->assertEquals(AbstractAccountHolder::KYC_STATUS_ADVANCED, $returnedContent->getImportedKycStatus());

        $this->assertEquals('3', $returnedContent->getAddress()->getFlatNumber());
        $this->assertEquals('28', $returnedContent->getAddress()->getBuildingNumber());
        $this->assertEquals('n/a', $returnedContent->getAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $returnedContent->getAddress()->getStreet());
        $this->assertEquals('N/A', $returnedContent->getAddress()->getSubStreet());
        $this->assertEquals('London', $returnedContent->getAddress()->getTown());
        $this->assertEquals('England', $returnedContent->getAddress()->getState());
        $this->assertEquals('EC1N 6TD', $returnedContent->getAddress()->getPostcode());
        $this->assertEquals('GBR', $returnedContent->getAddress()->getCountry());

        $this->assertEquals('info@johnpublic.com', $returnedContent->getCompany()->getEmail());
        $this->assertEquals('John Q. Public LTD', $returnedContent->getCompany()->getName());
        $this->assertEquals('0000000000', $returnedContent->getCompany()->getNumber());
        $this->assertEquals(Company::TYPE_BUSINESS, $returnedContent->getCompany()->getType());

        $this->assertEquals('3', $returnedContent->getCompany()->getAddress()->getFlatNumber());
        $this->assertEquals('28', $returnedContent->getCompany()->getAddress()->getBuildingNumber());
        $this->assertEquals('n/a', $returnedContent->getCompany()->getAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $returnedContent->getCompany()->getAddress()->getStreet());
        $this->assertEquals('N/A', $returnedContent->getCompany()->getAddress()->getSubStreet());
        $this->assertEquals('London', $returnedContent->getCompany()->getAddress()->getTown());
        $this->assertEquals('England', $returnedContent->getCompany()->getAddress()->getState());
        $this->assertEquals('EC1N 6TD', $returnedContent->getCompany()->getAddress()->getPostcode());
        $this->assertEquals('GBR', $returnedContent->getCompany()->getAddress()->getCountry());

        $reloadedContent = $this->finBlocks->api()->accountHolders()->show($returnedContent->getId());

        $this->assertEquals(AbstractAccountHolder::KYC_STATUS_ADVANCED, $reloadedContent->getKyc());
    }

    public function testCreateAnIncompleteAccountHolder()
    {
        $model = $this->finBlocks->factories()->accountHolders()->createBusiness();

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->accountHolders()->create($model);
    }

    public function testRetrieveNonExistingAccountHolder()
    {
        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->accountHolders()->show('non-existing-id');
    }

    public function testGetPaginatedAccountHolders()
    {
        $this->markTestSkipped('Not yet implemented');

        $returnedContent = $this->finBlocks->api()->accountHolders()->list(1, 2);

        $this->assertInstanceOf(AccountHoldersPagination::class, $returnedContent);
        $this->assertInternalType('array', $returnedContent->getItems());
        $this->assertInstanceOf(AccountHolderIndividual::class, $returnedContent->getItems()[0]);
        $this->assertInstanceOf(AccountHolderBusiness::class, $returnedContent->getItems()[1]);
    }

    public function testPaginatedAccountHoldersWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->accountHolders()->list(-1);
    }

    public function testPaginatedAccountHoldersWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->accountHolders()->list(1, -1);
    }

    public function testPaginatedAccountHoldersWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->accountHolders()->list(1, 10000);
    }

    public function testUpdateAccountHolderIndividual()
    {
        $model = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);

        $returnedModel = $this->finBlocks->api()->accountHolders()->create($model);

        $this->assertEquals('John Q. Public', $returnedModel->getLabel());

        $newLabel = sprintf('New label for Individual: %s', time());

        $returnedModel->setLabel($newLabel);

        $updatedModel = $this->finBlocks->api()->accountHolders()->update($returnedModel);

        $this->assertInstanceOf(AccountHolderIndividual::class, $updatedModel);
        $this->assertEquals($newLabel, $updatedModel->getLabel());
    }

    public function testUpdateAccountHolderBusiness()
    {
        $model = $this->traitCreateAccountHolderBusinessModel($this->finBlocks);

        $returnedModel = $this->finBlocks->api()->accountHolders()->create($model);

        $this->assertEquals('John Q. Public', $returnedModel->getLabel());

        $newLabel = sprintf('New label for Business: %s', time());

        $returnedModel->setLabel($newLabel);

        $updatedModel = $this->finBlocks->api()->accountHolders()->update($returnedModel);

        $this->assertInstanceOf(AccountHolderBusiness::class, $updatedModel);
        $this->assertEquals($newLabel, $updatedModel->getLabel());
    }

    public function testUpdateNonExistingAccountHolder()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);

        NSA::setProperty($accountHolder, 'id', 'invalid-account-holder');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->accountHolders()->update($accountHolder);
    }
}

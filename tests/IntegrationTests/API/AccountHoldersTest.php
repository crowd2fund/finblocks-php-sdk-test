<?php

namespace FinBlocks\Tests\IntegrationTests\API;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;
use FinBlocks\Model\AccountHolder\Company\Company;
use FinBlocks\Model\Address\Address;
use FinBlocks\Model\Pagination\AccountHoldersPagination;
use FinBlocks\Tests\Traits\AccountHolderTrait;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
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
        $this->assertEquals('pending', $returnedContent->getKyc());

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

        $this->assertEquals(true, in_array($reloadedContent->getKyc(), ['pending', 'basic']));
    }

    public function testCreateAccountHolderBusiness()
    {
        $model = $this->traitCreateAccountHolderBusinessModel($this->finBlocks);

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
        $this->assertEquals('pending', $returnedContent->getKyc());

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

        $this->assertEquals(true, in_array($reloadedContent->getKyc(), ['pending', 'basic']));
    }

    public function testCreateAnIncompleteAccountHolder()
    {
        $this->expectException(FinBlocksException::class);

        $model = $this->finBlocks->factories()->accountHolders()->createBusiness();

        $this->finBlocks->api()->accountHolders()->create($model);
    }

    public function testRetrieveNonExistingAccountHolder()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->accountHolders()->show('non-existing-id');
    }

    public function testGetPaginatedAccountHolders()
    {
        $returnedContent = $this->finBlocks->api()->accountHolders()->list(1, 2);

        $this->assertInstanceOf(AccountHoldersPagination::class, $returnedContent);
        $this->assertInternalType('array', $returnedContent->getEmbedded());
        $this->assertInstanceOf(AccountHolderIndividual::class, $returnedContent->getEmbedded()[0]);
        $this->assertInstanceOf(AccountHolderBusiness::class, $returnedContent->getEmbedded()[1]);
    }

    public function testInvalidArgumentsForPaginatedAccountHolders()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->accountHolders()->list(-1);
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
}

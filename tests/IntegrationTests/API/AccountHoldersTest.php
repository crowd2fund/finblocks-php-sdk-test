<?php

namespace FinBlocks\Tests\IntegrationTests\API;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;
use FinBlocks\Model\AccountHolder\Company\Company;
use FinBlocks\Model\Address\Address;
use FinBlocks\Model\Pagination\AccountHoldersPagination;

class AccountHoldersTest extends AbstractApiTests
{
    public function testCreateAccountHolderIndividual()
    {
        $model = $this->finBlocks->factories()->accountHolders()->createIndividual();

        $model->setEmail('individual@johnpublic.com');
        $model->setLabel('John Q. Public');
        $model->setTag('Individual Test User');
        $model->setGivenName('John');
        $model->setMiddleName('Q.');
        $model->setFamilyName('Public');
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1985-04-23'));
        $model->setNationality('GBR');
        $model->setOccupation('Unknown');
        $model->setIncomeRange(6);
        $model->getAddress()->setFlatNumber('3');
        $model->getAddress()->setBuildingNumber('28');
        $model->getAddress()->setBuildingName('n/a');
        $model->getAddress()->setStreet('Ely Place');
        $model->getAddress()->setSubStreet('N/A');
        $model->getAddress()->setTown('London');
        $model->getAddress()->setState('England');
        $model->getAddress()->setPostcode('EC1N 6TD');
        $model->getAddress()->setCountry('GBR');

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
        //TODO: Enable this check again
        //$this->assertEquals('pending', $returnedContent->getKyc());

        $this->assertEquals('3', $returnedContent->getAddress()->getFlatNumber());
        $this->assertEquals('28', $returnedContent->getAddress()->getBuildingNumber());
        $this->assertEquals('n/a', $returnedContent->getAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $returnedContent->getAddress()->getStreet());
        $this->assertEquals('N/A', $returnedContent->getAddress()->getSubStreet());
        $this->assertEquals('London', $returnedContent->getAddress()->getTown());
        $this->assertEquals('England', $returnedContent->getAddress()->getState());
        $this->assertEquals('EC1N 6TD', $returnedContent->getAddress()->getPostcode());
        $this->assertEquals('GBR', $returnedContent->getAddress()->getCountry());

        //$reloadedContent = $this->finBlocks->api()->accountHolders()->show($returnedContent->getId());
        //$reloadedContent = $this->finBlocks->api()->accountHolders()->show('accountholder-e5e2ad73-096b-4401-8df6-ec5c2cb6bb55');

        //$this->assertEquals(true, in_array($reloadedContent->getKyc(), ['pending', 'basic']));
    }

    public function testCreateAccountHolderBusiness()
    {
        $model = $this->finBlocks->factories()->accountHolders()->createBusiness();
        $model->setEmail('business@johnpublic.com');
        $model->setLabel('John Q. Public');
        $model->setTag('Business Test User');
        $model->setGivenName('John');
        $model->setMiddleName('Q.');
        $model->setFamilyName('Public');
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1985-04-23'));
        $model->setNationality('GBR');
        $model->setOccupation('CEO');
        $model->setIncomeRange(6);
        $model->getAddress()->setFlatNumber('3');
        $model->getAddress()->setBuildingNumber('28');
        $model->getAddress()->setBuildingName('n/a');
        $model->getAddress()->setStreet('Ely Place');
        $model->getAddress()->setSubStreet('N/A');
        $model->getAddress()->setTown('London');
        $model->getAddress()->setState('England');
        $model->getAddress()->setPostcode('EC1N 6TD');
        $model->getAddress()->setCountry('GBR');
        $model->getCompany()->setEmail('info@johnpublic.com');
        $model->getCompany()->setName('John Q. Public LTD');
        $model->getCompany()->setNumber('0000000000');
        $model->getCompany()->setType(Company::TYPE_BUSINESS);
        $model->getCompany()->getAddress()->setFlatNumber('3');
        $model->getCompany()->getAddress()->setBuildingNumber('28');
        $model->getCompany()->getAddress()->setBuildingName('n/a');
        $model->getCompany()->getAddress()->setStreet('Ely Place');
        $model->getCompany()->getAddress()->setSubStreet('N/A');
        $model->getCompany()->getAddress()->setTown('London');
        $model->getCompany()->getAddress()->setState('England');
        $model->getCompany()->getAddress()->setPostcode('EC1N 6TD');
        $model->getCompany()->getAddress()->setCountry('GBR');

        /** @var AccountHolderBusiness $returnedContent */
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
        //TODO: Enable this check again
        //$this->assertEquals('pending', $returnedContent->getKyc());

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

        //$reloadedContent = $this->finBlocks->api()->accountHolders()->show($returnedContent->getId());

        //$this->assertEquals(true, in_array($reloadedContent->getKyc(), ['pending', 'basic']));
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
        $newLabel = sprintf('New label for Individual: %s', time());

        $model = $this->finBlocks->api()->accountHolders()->show('accountholder-e5e2ad73-096b-4401-8df6-ec5c2cb6bb55');
        $model->setLabel($newLabel);

        $returnedContent = $this->finBlocks->api()->accountHolders()->update($model);

        $this->assertInstanceOf(AccountHolderIndividual::class, $returnedContent);
        $this->assertEquals($newLabel, $returnedContent->getLabel());
    }

    public function testUpdateAccountHolderBusiness()
    {
        $model = $this->finBlocks->api()->accountHolders()->show('2');
        $model->setLabel('New Label for Business');

        $returnedContent = $this->finBlocks->api()->accountHolders()->update($model);

        $this->assertInstanceOf(AccountHolderBusiness::class, $returnedContent);
        $this->assertEquals('New Label for Business', $returnedContent->getLabel());
    }
}

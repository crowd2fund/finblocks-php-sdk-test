<?php

namespace Finblocks\Tests\UnitTesting\Model\AccountHolder;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;
use FinBlocks\Model\AccountHolder\Company\Company;
use FinBlocks\Model\Address\Address;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class AccountHolderTest extends TestCase
{
    public function testCreateEmptyModelAndSettersForIndividual()
    {
        $model = AccountHolderIndividual::create();
        $model->setEmail('mailbox@domain.com');
        $model->setLabel('label');
        $model->setTag('tag');
        $model->setGivenName('John');
        $model->setMiddleName('Q.');
        $model->setFamilyName('Public');
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1983-04-10'));
        $model->setNationality('GBR');
        $model->setOccupation('Unknown');
        $model->setIncomeRange(6);

        $this->assertEquals('mailbox@domain.com', $model->getEmail());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
        $this->assertEquals('John', $model->getGivenName());
        $this->assertEquals('Q.', $model->getMiddleName());
        $this->assertEquals('Public', $model->getFamilyName());
        $this->assertEquals('GBR', $model->getNationality());
        $this->assertEquals('Unknown', $model->getOccupation());
        $this->assertEquals(6, $model->getIncomeRange());

        $this->assertInstanceOf(\DateTime::class, $model->getDateOfBirth());
        $this->assertEquals('1983-04-10', $model->getDateOfBirth()->format('Y-m-d'));
    }

    public function testCreateFilledModelFromJsonPayloadForIndividual()
    {
        $model = AccountHolderIndividual::createFromPayload('{
  "id": "1111",
  "type": "individual",
  "email": "individual@test.finblocks.net",
  "label": "Individual Account Holder\'s Label",
  "tag": "Individual Account Holder\'s Tag",
  "givenName": "John",
  "middleName": "Q.",
  "familyName": "Public",
  "dateOfBirth": "1983-04-10T00:00:00.000Z",
  "nationality": "GBR",
  "occupation": "Unknown",
  "incomeRange": 6,
  "kyc": "verified",
  "address": {
    "flatNumber": "3",
    "buildingNumber": "28",
    "buildingName": null,
    "street": "Ely Place",
    "subStreet": null,
    "town": "London",
    "state": "England",
    "postcode": "EC1N 6TD",
    "country": "GBR"
  }
}');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('individual', $model->getType());
        $this->assertEquals('individual@test.finblocks.net', $model->getEmail());
        $this->assertEquals('Individual Account Holder\'s Label', $model->getLabel());
        $this->assertEquals('Individual Account Holder\'s Tag', $model->getTag());
        $this->assertEquals('John', $model->getGivenName());
        $this->assertEquals('Q.', $model->getMiddleName());
        $this->assertEquals('Public', $model->getFamilyName());
        $this->assertEquals('GBR', $model->getNationality());
        $this->assertEquals('Unknown', $model->getOccupation());
        $this->assertEquals(6, $model->getIncomeRange());
        $this->assertEquals('verified', $model->getKyc());

        $this->assertInstanceOf(\DateTime::class, $model->getDateOfBirth());

        $this->assertEquals('1983-04-10', $model->getDateOfBirth()->format('Y-m-d'));

        $this->assertInstanceOf(Address::class, $model->getAddress());

        $this->assertEquals('3', $model->getAddress()->getFlatNumber());
        $this->assertEquals('28', $model->getAddress()->getBuildingNumber());
        $this->assertEquals(null, $model->getAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $model->getAddress()->getStreet());
        $this->assertEquals(null, $model->getAddress()->getSubStreet());
        $this->assertEquals('London', $model->getAddress()->getTown());
        $this->assertEquals('England', $model->getAddress()->getState());
        $this->assertEquals('EC1N 6TD', $model->getAddress()->getPostcode());
        $this->assertEquals('GBR', $model->getAddress()->getCountry());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForIndividual()
    {
        $this->expectException(FinBlocksException::class);

        AccountHolderIndividual::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForIndividual()
    {
        $model = AccountHolderIndividual::create();
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1983-04-10'));

        $array = $model->httpCreate();

        $this->assertCount(11, $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('givenName', $array);
        $this->assertArrayHasKey('middleName', $array);
        $this->assertArrayHasKey('familyName', $array);
        $this->assertArrayHasKey('dateOfBirth', $array);
        $this->assertArrayHasKey('nationality', $array);
        $this->assertArrayHasKey('occupation', $array);
        $this->assertArrayHasKey('incomeRange', $array);
        $this->assertArrayHasKey('address', $array);

        $this->assertCount(9, $array['address']);
        $this->assertArrayHasKey('flatNumber', $array['address']);
        $this->assertArrayHasKey('buildingNumber', $array['address']);
        $this->assertArrayHasKey('buildingName', $array['address']);
        $this->assertArrayHasKey('street', $array['address']);
        $this->assertArrayHasKey('subStreet', $array['address']);
        $this->assertArrayHasKey('town', $array['address']);
        $this->assertArrayHasKey('state', $array['address']);
        $this->assertArrayHasKey('postcode', $array['address']);
        $this->assertArrayHasKey('country', $array['address']);
    }

    public function testUpdateArrayForIndividual()
    {
        $model = AccountHolderIndividual::create();
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1983-04-10'));

        $array = $model->httpUpdate();

        $this->assertCount(11, $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('givenName', $array);
        $this->assertArrayHasKey('middleName', $array);
        $this->assertArrayHasKey('familyName', $array);
        $this->assertArrayHasKey('dateOfBirth', $array);
        $this->assertArrayHasKey('nationality', $array);
        $this->assertArrayHasKey('occupation', $array);
        $this->assertArrayHasKey('incomeRange', $array);
        $this->assertArrayHasKey('address', $array);

        $this->assertCount(9, $array['address']);
        $this->assertArrayHasKey('flatNumber', $array['address']);
        $this->assertArrayHasKey('buildingNumber', $array['address']);
        $this->assertArrayHasKey('buildingName', $array['address']);
        $this->assertArrayHasKey('street', $array['address']);
        $this->assertArrayHasKey('subStreet', $array['address']);
        $this->assertArrayHasKey('town', $array['address']);
        $this->assertArrayHasKey('state', $array['address']);
        $this->assertArrayHasKey('postcode', $array['address']);
        $this->assertArrayHasKey('country', $array['address']);
    }

    public function testCreateEmptyModelAndSettersForBusiness()
    {
        $model = AccountHolderBusiness::create();
        $model->setEmail('mailbox@domain.com');
        $model->setLabel('label');
        $model->setTag('tag');
        $model->setGivenName('John');
        $model->setMiddleName('Q.');
        $model->setFamilyName('Public');
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1983-04-10'));
        $model->setNationality('GBR');
        $model->setOccupation('Unknown');
        $model->setIncomeRange(6);

        $this->assertEquals('mailbox@domain.com', $model->getEmail());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
        $this->assertEquals('John', $model->getGivenName());
        $this->assertEquals('Q.', $model->getMiddleName());
        $this->assertEquals('Public', $model->getFamilyName());
        $this->assertEquals('GBR', $model->getNationality());
        $this->assertEquals('Unknown', $model->getOccupation());
        $this->assertEquals(6, $model->getIncomeRange());

        $this->assertInstanceOf(\DateTime::class, $model->getDateOfBirth());
        $this->assertEquals('1983-04-10', $model->getDateOfBirth()->format('Y-m-d'));
    }

    public function testCreateFilledModelFromJsonPayloadForBusiness()
    {
        $model = AccountHolderBusiness::createFromPayload('{
  "id": "1111",
  "type": "business",
  "email": "business@test.finblocks.net",
  "label": "Business Account Holder\'s Label",
  "tag": "Business Account Holder\'s Tag",
  "givenName": "John",
  "middleName": "Q.",
  "familyName": "Public",
  "dateOfBirth": "1983-04-10T00:00:00.000Z",
  "nationality": "GBR",
  "occupation": "Unknown",
  "incomeRange": 6,
  "kyc": "restricted",
  "address": {
    "flatNumber": "3",
    "buildingNumber": "28",
    "buildingName": null,
    "street": "Ely Place",
    "subStreet": null,
    "town": "London",
    "state": "England",
    "postcode": "EC1N 6TD",
    "country": "GBR"
  },
  "company": {
    "number": "1234567890",
    "name": "Company Name",
    "email": "company@test.finblocks.net",
    "type": "business",
    "address": {
      "flatNumber": "3",
      "buildingNumber": "28",
      "buildingName": null,
      "street": "Ely Place",
      "subStreet": null,
      "town": "London",
      "state": "England",
      "postcode": "EC1N 6TD",
      "country": "GBR"
    }
  }
}');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('business', $model->getType());
        $this->assertEquals('business@test.finblocks.net', $model->getEmail());
        $this->assertEquals('Business Account Holder\'s Label', $model->getLabel());
        $this->assertEquals('Business Account Holder\'s Tag', $model->getTag());
        $this->assertEquals('John', $model->getGivenName());
        $this->assertEquals('Q.', $model->getMiddleName());
        $this->assertEquals('Public', $model->getFamilyName());
        $this->assertEquals('GBR', $model->getNationality());
        $this->assertEquals('Unknown', $model->getOccupation());
        $this->assertEquals(6, $model->getIncomeRange());
        $this->assertEquals('restricted', $model->getKyc());

        $this->assertInstanceOf(\DateTime::class, $model->getDateOfBirth());

        $this->assertEquals('1983-04-10', $model->getDateOfBirth()->format('Y-m-d'));

        $this->assertInstanceOf(Address::class, $model->getAddress());

        $this->assertEquals('3', $model->getAddress()->getFlatNumber());
        $this->assertEquals('28', $model->getAddress()->getBuildingNumber());
        $this->assertEquals(null, $model->getAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $model->getAddress()->getStreet());
        $this->assertEquals(null, $model->getAddress()->getSubStreet());
        $this->assertEquals('London', $model->getAddress()->getTown());
        $this->assertEquals('England', $model->getAddress()->getState());
        $this->assertEquals('EC1N 6TD', $model->getAddress()->getPostcode());
        $this->assertEquals('GBR', $model->getAddress()->getCountry());

        $this->assertInstanceOf(Company::class, $model->getCompany());

        $this->assertEquals('1234567890', $model->getCompany()->getNumber());
        $this->assertEquals('Company Name', $model->getCompany()->getName());
        $this->assertEquals('company@test.finblocks.net', $model->getCompany()->getEmail());
        $this->assertEquals(Company::TYPE_BUSINESS, $model->getCompany()->getType());

        $this->assertInstanceOf(Address::class, $model->getCompany()->getAddress());

        $this->assertEquals('3', $model->getCompany()->getAddress()->getFlatNumber());
        $this->assertEquals('28', $model->getCompany()->getAddress()->getBuildingNumber());
        $this->assertEquals(null, $model->getCompany()->getAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $model->getCompany()->getAddress()->getStreet());
        $this->assertEquals(null, $model->getCompany()->getAddress()->getSubStreet());
        $this->assertEquals('London', $model->getCompany()->getAddress()->getTown());
        $this->assertEquals('England', $model->getCompany()->getAddress()->getState());
        $this->assertEquals('EC1N 6TD', $model->getCompany()->getAddress()->getPostcode());
        $this->assertEquals('GBR', $model->getCompany()->getAddress()->getCountry());
    }

    public function testCreateFilledModelFromWrongJsonPayloadForBusiness()
    {
        $this->expectException(FinBlocksException::class);

        AccountHolderBusiness::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForBusiness()
    {
        $model = AccountHolderBusiness::create();
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1983-04-10'));

        $array = $model->httpCreate();

        $this->assertCount(12, $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('givenName', $array);
        $this->assertArrayHasKey('middleName', $array);
        $this->assertArrayHasKey('familyName', $array);
        $this->assertArrayHasKey('dateOfBirth', $array);
        $this->assertArrayHasKey('nationality', $array);
        $this->assertArrayHasKey('occupation', $array);
        $this->assertArrayHasKey('incomeRange', $array);
        $this->assertArrayHasKey('address', $array);
        $this->assertArrayHasKey('company', $array);

        $this->assertCount(9, $array['address']);
        $this->assertArrayHasKey('flatNumber', $array['address']);
        $this->assertArrayHasKey('buildingNumber', $array['address']);
        $this->assertArrayHasKey('buildingName', $array['address']);
        $this->assertArrayHasKey('street', $array['address']);
        $this->assertArrayHasKey('subStreet', $array['address']);
        $this->assertArrayHasKey('town', $array['address']);
        $this->assertArrayHasKey('state', $array['address']);
        $this->assertArrayHasKey('postcode', $array['address']);
        $this->assertArrayHasKey('country', $array['address']);

        $this->assertCount(5, $array['company']);
        $this->assertArrayHasKey('number', $array['company']);
        $this->assertArrayHasKey('name', $array['company']);
        $this->assertArrayHasKey('email', $array['company']);
        $this->assertArrayHasKey('type', $array['company']);
        $this->assertArrayHasKey('address', $array['company']);

        $this->assertCount(9, $array['company']['address']);
        $this->assertArrayHasKey('flatNumber', $array['company']['address']);
        $this->assertArrayHasKey('buildingNumber', $array['company']['address']);
        $this->assertArrayHasKey('buildingName', $array['company']['address']);
        $this->assertArrayHasKey('street', $array['company']['address']);
        $this->assertArrayHasKey('subStreet', $array['company']['address']);
        $this->assertArrayHasKey('town', $array['company']['address']);
        $this->assertArrayHasKey('state', $array['company']['address']);
        $this->assertArrayHasKey('postcode', $array['company']['address']);
        $this->assertArrayHasKey('country', $array['company']['address']);
    }

    public function testUpdateArrayForBusiness()
    {
        $model = AccountHolderBusiness::create();
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1983-04-10'));

        $array = $model->httpUpdate();

        $this->assertCount(12, $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('givenName', $array);
        $this->assertArrayHasKey('middleName', $array);
        $this->assertArrayHasKey('familyName', $array);
        $this->assertArrayHasKey('dateOfBirth', $array);
        $this->assertArrayHasKey('nationality', $array);
        $this->assertArrayHasKey('occupation', $array);
        $this->assertArrayHasKey('incomeRange', $array);
        $this->assertArrayHasKey('address', $array);
        $this->assertArrayHasKey('company', $array);

        $this->assertCount(9, $array['address']);
        $this->assertArrayHasKey('flatNumber', $array['address']);
        $this->assertArrayHasKey('buildingNumber', $array['address']);
        $this->assertArrayHasKey('buildingName', $array['address']);
        $this->assertArrayHasKey('street', $array['address']);
        $this->assertArrayHasKey('subStreet', $array['address']);
        $this->assertArrayHasKey('town', $array['address']);
        $this->assertArrayHasKey('state', $array['address']);
        $this->assertArrayHasKey('postcode', $array['address']);
        $this->assertArrayHasKey('country', $array['address']);

        $this->assertCount(5, $array['company']);
        $this->assertArrayHasKey('number', $array['company']);
        $this->assertArrayHasKey('name', $array['company']);
        $this->assertArrayHasKey('email', $array['company']);
        $this->assertArrayHasKey('type', $array['company']);
        $this->assertArrayHasKey('address', $array['company']);

        $this->assertCount(9, $array['company']['address']);
        $this->assertArrayHasKey('flatNumber', $array['company']['address']);
        $this->assertArrayHasKey('buildingNumber', $array['company']['address']);
        $this->assertArrayHasKey('buildingName', $array['company']['address']);
        $this->assertArrayHasKey('street', $array['company']['address']);
        $this->assertArrayHasKey('subStreet', $array['company']['address']);
        $this->assertArrayHasKey('town', $array['company']['address']);
        $this->assertArrayHasKey('state', $array['company']['address']);
        $this->assertArrayHasKey('postcode', $array['company']['address']);
        $this->assertArrayHasKey('country', $array['company']['address']);
    }
}

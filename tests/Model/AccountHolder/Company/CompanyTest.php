<?php

namespace FinBlocks\Tests\Model\AccountHolder\Company;

use FinBlocks\Exception\FinBlocksException;
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
class CompanyTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Company::create();
        $model->setName('FINBLOCKS LTD');
        $model->setNumber('11269670');
        $model->setEmail('info@finblocks.net');
        $model->setType(Company::TYPE_BUSINESS);

        $this->assertEquals('FINBLOCKS LTD', $model->getName());
        $this->assertEquals('11269670', $model->getNumber());
        $this->assertEquals('info@finblocks.net', $model->getEmail());
        $this->assertEquals(Company::TYPE_BUSINESS, $model->getType());

        $this->assertInstanceOf(Address::class, $model->getAddress());
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Company::createFromPayload('{
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
  }');

        $this->assertEquals('1234567890', $model->getNumber());
        $this->assertEquals('Company Name', $model->getName());
        $this->assertEquals('company@test.finblocks.net', $model->getEmail());
        $this->assertEquals(Company::TYPE_BUSINESS, $model->getType());

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

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Company::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $model = Company::create();

        $array = $model->httpCreate();

        $this->assertArrayHasKey('number', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('type', $array);
        $this->assertArrayHasKey('address', $array);
    }

    public function testUpdateArray()
    {
        $model = Company::create();

        $array = $model->httpUpdate();

        $this->assertArrayHasKey('number', $array);
        $this->assertArrayHasKey('name', $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('type', $array);
        $this->assertArrayHasKey('address', $array);
    }
}

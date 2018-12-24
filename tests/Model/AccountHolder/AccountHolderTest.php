<?php

namespace FinBlocks\Tests\Model\AccountHolder;

use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;
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
    public function testModelSettersForIndividual()
    {
        $model = new AccountHolderIndividual();
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

    public function testCreateArrayForIndividual()
    {
        $model = new AccountHolderIndividual();
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
        $model = new AccountHolderIndividual();
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

    public function testModelSettersForBusiness()
    {
        $model = new AccountHolderBusiness();
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

    public function testCreateArrayForBusiness()
    {
        $model = new AccountHolderBusiness();
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
        $model = new AccountHolderBusiness();
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
}

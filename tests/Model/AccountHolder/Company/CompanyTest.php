<?php

namespace FinBlocks\Tests\Model\AccountHolder\Company;

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

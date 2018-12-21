<?php

namespace FinBlocks\Tests\Model\Address;

use FinBlocks\Model\Address\Address;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class AddressTest extends TestCase
{
    public function testSettersForAddressModel()
    {
        $model = new Address();
        $model->setFlatNumber('3');
        $model->setBuildingNumber('28');
        $model->setBuildingName('n/a');
        $model->setStreet('Ely Place');
        $model->setSubStreet('n/a 2');
        $model->setTown('London');
        $model->setState('England');
        $model->setPostcode('EC1N 6TD');
        $model->setCountry('GBR');

        $this->assertEquals('3', $model->getFlatNumber());
        $this->assertEquals('28', $model->getBuildingNumber());
        $this->assertEquals('n/a', $model->getBuildingName());
        $this->assertEquals('Ely Place', $model->getStreet());
        $this->assertEquals('n/a 2', $model->getSubStreet());
        $this->assertEquals('London', $model->getTown());
        $this->assertEquals('England', $model->getState());
        $this->assertEquals('EC1N 6TD', $model->getPostcode());
        $this->assertEquals('GBR', $model->getCountry());
    }

    public function testCreateArray()
    {
        $model = new Address();

        $array = $model->httpCreate();

        $this->assertArrayHasKey('flatNumber', $array);
        $this->assertArrayHasKey('buildingNumber', $array);
        $this->assertArrayHasKey('buildingName', $array);
        $this->assertArrayHasKey('street', $array);
        $this->assertArrayHasKey('subStreet', $array);
        $this->assertArrayHasKey('town', $array);
        $this->assertArrayHasKey('state', $array);
        $this->assertArrayHasKey('postcode', $array);
        $this->assertArrayHasKey('country', $array);
    }

    public function testUpdateArray()
    {
        $model = new Address();

        $array = $model->httpUpdate();

        $this->assertArrayHasKey('flatNumber', $array);
        $this->assertArrayHasKey('buildingNumber', $array);
        $this->assertArrayHasKey('buildingName', $array);
        $this->assertArrayHasKey('street', $array);
        $this->assertArrayHasKey('subStreet', $array);
        $this->assertArrayHasKey('town', $array);
        $this->assertArrayHasKey('state', $array);
        $this->assertArrayHasKey('postcode', $array);
        $this->assertArrayHasKey('country', $array);
    }
}

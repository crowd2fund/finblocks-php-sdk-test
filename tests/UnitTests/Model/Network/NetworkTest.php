<?php

namespace Finblocks\Tests\UnitTests\Model\Network;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Address\Address;
use FinBlocks\Model\Network\Network;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class NetworkTest extends TestCase
{
    public function testCreate()
    {
        $this->expectException(FinBlocksException::class);

        Network::create();
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Network::createFromPayload('{
            "id": "1111",
            "name": "Company Name",
            "legalName": "Registered Name",
            "type": "MARKETPLACE",
            "techEmails": [
                "tech@company.finblocks.net"
            ],
            "adminEmails": [
                "admin@company.finblocks.net"
            ],
            "billingEmails": [
                "billing@company.finblocks.net"
            ],
            "fraudEmails": [
                "fraud@company.finblocks.net"
            ],
            "address": {
                "flatNumber": "string",
                "buildingNumber": "string",
                "buildingName": "string",
                "street": "string",
                "subStreet": "string",
                "town": "string",
                "state": "string",
                "postcode": "string",
                "country": "string"
            },
            "phoneNumber": "+442000000000",
            "taxNumber": null,
            "businessType": "MARKETPLACE",
            "businessIndustry": "RENTALS",
            "url": "https://www.company.com",
            "label": "Network\'s Label",
            "reference": "QWERTY",
            "primaryThemeColour": "000000",
            "primaryButtonColour": "FFFFFF",
            "logo": "https://www.company.com/assets/images/logo.png"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('Company Name', $model->getName());
        $this->assertEquals('Registered Name', $model->getLegalName());
        $this->assertEquals('MARKETPLACE', $model->getType());
        $this->assertEquals('+442000000000', $model->getPhoneNumber());
        $this->assertEquals(null, $model->getTaxNumber());
        $this->assertEquals('MARKETPLACE', $model->getBusinessType());
        $this->assertEquals('RENTALS', $model->getBusinessIndustry());
        $this->assertEquals('https://www.company.com', $model->getUrl());
        $this->assertEquals('Network\'s Label', $model->getLabel());
        $this->assertEquals('QWERTY', $model->getReference());
        $this->assertEquals('000000', $model->getPrimaryThemeColour());
        $this->assertEquals('FFFFFF', $model->getPrimaryButtonColour());
        $this->assertEquals('https://www.company.com/assets/images/logo.png', $model->getLogo());

        $this->assertInternalType('array', $model->getTechEmails());
        $this->assertCount(1, $model->getTechEmails());
        $this->assertEquals('tech@company.finblocks.net', $model->getTechEmails()[0]);

        $this->assertInternalType('array', $model->getAdminEmails());
        $this->assertCount(1, $model->getAdminEmails());
        $this->assertEquals('admin@company.finblocks.net', $model->getAdminEmails()[0]);

        $this->assertInternalType('array', $model->getBillingEmails());
        $this->assertCount(1, $model->getBillingEmails());
        $this->assertEquals('billing@company.finblocks.net', $model->getBillingEmails()[0]);

        $this->assertInternalType('array', $model->getFraudEmails());
        $this->assertCount(1, $model->getFraudEmails());
        $this->assertEquals('fraud@company.finblocks.net', $model->getFraudEmails()[0]);

        $this->assertInstanceOf(Address::class, $model->getAddress());
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Network::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Network::createFromPayload('{}');
        $model->httpCreate();
    }

    public function testModelSettersUpdateArray()
    {
        $model = Network::createFromPayload('{}');

        $model->setAdminEmails(['admin@domain.com']);
        $model->setBillingEmails(['billing@domain.com']);
        $model->setFraudEmails(['fraud@domain.com']);
        $model->setTechEmails(['tech@domain.com']);
        $model->setLabel('Label');
        $model->setLogo('https://domain.com/images/logo.png');
        $model->setPhoneNumber('+447000000000');
        $model->setPrimaryThemeColour('ABCDEF');
        $model->setPrimaryButtonColour('123456');
        $model->setUrl('https://domain.com');
        $model->getAddress()->setBuildingName('Building Name');

        $array = $model->httpUpdate();

        $this->assertCount(11, $array);
        $this->assertArrayHasKey('adminEmails', $array);
        $this->assertArrayHasKey('billingEmails', $array);
        $this->assertArrayHasKey('fraudEmails', $array);
        $this->assertArrayHasKey('techEmails', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('logo', $array);
        $this->assertArrayHasKey('phoneNumber', $array);
        $this->assertArrayHasKey('primaryThemeColour', $array);
        $this->assertArrayHasKey('primaryButtonColour', $array);
        $this->assertArrayHasKey('url', $array);
        $this->assertArrayHasKey('address', $array);

        $this->assertEquals(['admin@domain.com'], $array['adminEmails']);
        $this->assertEquals(['billing@domain.com'], $array['billingEmails']);
        $this->assertEquals(['fraud@domain.com'], $array['fraudEmails']);
        $this->assertEquals(['tech@domain.com'], $array['techEmails']);
        $this->assertEquals('Label', $array['label']);
        $this->assertEquals('https://domain.com/images/logo.png', $array['logo']);
        $this->assertEquals('+447000000000', $array['phoneNumber']);
        $this->assertEquals('ABCDEF', $array['primaryThemeColour']);
        $this->assertEquals('123456', $array['primaryButtonColour']);
        $this->assertEquals('https://domain.com', $array['url']);
        $this->assertEquals('Building Name', $array['address']['buildingName']);
    }
}

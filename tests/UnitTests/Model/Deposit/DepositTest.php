<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Deposit;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Address\Address;
use FinBlocks\Model\Deposit\DepositBankWire;
use FinBlocks\Model\Deposit\DepositCard;
use FinBlocks\Model\Deposit\DepositDirectDebit;
use FinBlocks\Model\Money\Money;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class DepositTest extends TestCase
{
    public function testCreateEmptyModelAndSettersForBankWire()
    {
        $model = DepositBankWire::create();
        $model->setTo('12345678');

        // There's no Getter, please refer to the testCreateArrayForBankWire's method.
        $model->setReturnUrl('url');

        // TODO: Add Label and Tag
        //$model->setLabel('label');
        //$model->setTag('tag');

        $this->assertEquals('12345678', $model->getTo());
        //$this->assertEquals('label', $model->getLabel());
        //$this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayloadForBankWire()
    {
        $model = DepositBankWire::createFromPayload('{
            "id": "1111",
            "type": "bankWire",
            "nature": "deposit",
            "status": "succeeded",
            "to": "2222",
            "createdAt": "2019-01-02T13:02:18.341Z",
            "executedAt": "2019-01-02T13:02:18.341Z",
            "expiresAt": "2019-02-01T13:02:18.341Z",
            "billingAddress": {
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
            "debitedAmount": {
                "currency": "GBP",
                "amount": 200000
            },
            "creditedAmount": {
                "currency": "GBP",
                "amount": 200000
            },
            "fees": {
                "currency": "GBP",
                "amount": 0
            },
            "declaredDebitedAmount": {
                "currency": "GBP",
                "amount": 250000
            },
            "declaredFees": {
                "currency": "GBP",
                "amount": 0
            },
            "wireReference": "QWERTY"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('bankWire', $model->getType());
        $this->assertEquals('deposit', $model->getNature());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('2222', $model->getTo());
        $this->assertEquals('QWERTY', $model->getWireReference());

        $this->assertInstanceOf(Address::class, $model->getBillingAddress());

        $this->assertEquals('3', $model->getBillingAddress()->getFlatNumber());
        $this->assertEquals('28', $model->getBillingAddress()->getBuildingNumber());
        $this->assertEquals(null, $model->getBillingAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $model->getBillingAddress()->getStreet());
        $this->assertEquals(null, $model->getBillingAddress()->getSubStreet());
        $this->assertEquals('London', $model->getBillingAddress()->getTown());
        $this->assertEquals('England', $model->getBillingAddress()->getState());
        $this->assertEquals('EC1N 6TD', $model->getBillingAddress()->getPostcode());
        $this->assertEquals('GBR', $model->getBillingAddress()->getCountry());

        $this->assertInstanceOf(Money::class, $model->getDebitedAmount());
        $this->assertInstanceOf(Money::class, $model->getCreditedAmount());
        $this->assertInstanceOf(Money::class, $model->getFees());
        $this->assertInstanceOf(Money::class, $model->getDeclaredDebitedAmount());
        $this->assertInstanceOf(Money::class, $model->getDeclaredFees());

        $this->assertEquals('GBP', $model->getDebitedAmount()->getCurrency());
        $this->assertEquals(200000, $model->getDebitedAmount()->getAmount());

        $this->assertEquals('GBP', $model->getCreditedAmount()->getCurrency());
        $this->assertEquals(200000, $model->getCreditedAmount()->getAmount());

        $this->assertEquals('GBP', $model->getFees()->getCurrency());
        $this->assertEquals(0, $model->getFees()->getAmount());

        $this->assertEquals('GBP', $model->getDeclaredDebitedAmount()->getCurrency());
        $this->assertEquals(250000, $model->getDeclaredDebitedAmount()->getAmount());

        $this->assertEquals('GBP', $model->getDeclaredFees()->getCurrency());
        $this->assertEquals(0, $model->getDeclaredFees()->getAmount());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getExecutedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getExpiresAt());

        $this->assertEquals('2019-01-02 13:02:18', $model->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2019-01-02 13:02:18', $model->getExecutedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2019-02-01 13:02:18', $model->getExpiresAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayloadForBankWire()
    {
        $this->expectException(FinBlocksException::class);

        DepositBankWire::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForBankWire()
    {
        $model = DepositBankWire::create();
        $model->setReturnUrl('url');

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('to', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('amount', $array);
        $this->assertArrayHasKey('fees', $array);
    }

    public function testUpdateArrayForBankWire()
    {
        $this->expectException(FinBlocksException::class);

        $model = DepositBankWire::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForCard()
    {
        $model = DepositCard::create();
        $model->setTo('12345678');
        $model->setCardId('87654321');
        $model->setSecureMode(true);

        // There's no Getter, please refer to the testCreateArrayForBankWire's method.
        $model->setReturnUrl('url');

        // TODO: Add Label and Tag
        //$model->setLabel('label');
        //$model->setTag('tag');

        $this->assertEquals('12345678', $model->getTo());
        $this->assertEquals('87654321', $model->getCardId());
        $this->assertEquals(true, $model->isSecureMode());
        //$this->assertEquals('label', $model->getLabel());
        //$this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayloadForCard()
    {
        $model = DepositCard::createFromPayload('{
            "id": "1111",
            "type": "card",
            "nature": "deposit",
            "status": "succeeded",
            "to": "2222",
            "createdAt": "2019-01-02T13:02:18.341Z",
            "executedAt": "2019-01-02T13:02:18.341Z",
            "expiresAt": "2019-02-01T13:02:18.341Z",
            "billingAddress": {
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
            "debitedAmount": {
                "currency": "GBP",
                "amount": 200000
            },
            "creditedAmount": {
                "currency": "GBP",
                "amount": 200000
            },
            "fees": {
                "currency": "GBP",
                "amount": 0
            },
            "cardId": "3333",
            "secureMode": true
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('card', $model->getType());
        $this->assertEquals('deposit', $model->getNature());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('2222', $model->getTo());
        $this->assertEquals('3333', $model->getCardId());
        $this->assertEquals(true, $model->isSecureMode());

        $this->assertInstanceOf(Address::class, $model->getBillingAddress());

        $this->assertEquals('3', $model->getBillingAddress()->getFlatNumber());
        $this->assertEquals('28', $model->getBillingAddress()->getBuildingNumber());
        $this->assertEquals(null, $model->getBillingAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $model->getBillingAddress()->getStreet());
        $this->assertEquals(null, $model->getBillingAddress()->getSubStreet());
        $this->assertEquals('London', $model->getBillingAddress()->getTown());
        $this->assertEquals('England', $model->getBillingAddress()->getState());
        $this->assertEquals('EC1N 6TD', $model->getBillingAddress()->getPostcode());
        $this->assertEquals('GBR', $model->getBillingAddress()->getCountry());

        $this->assertInstanceOf(Money::class, $model->getDebitedAmount());
        $this->assertInstanceOf(Money::class, $model->getCreditedAmount());
        $this->assertInstanceOf(Money::class, $model->getFees());

        $this->assertEquals('GBP', $model->getDebitedAmount()->getCurrency());
        $this->assertEquals(200000, $model->getDebitedAmount()->getAmount());

        $this->assertEquals('GBP', $model->getCreditedAmount()->getCurrency());
        $this->assertEquals(200000, $model->getCreditedAmount()->getAmount());

        $this->assertEquals('GBP', $model->getFees()->getCurrency());
        $this->assertEquals(0, $model->getFees()->getAmount());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getExecutedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getExpiresAt());

        $this->assertEquals('2019-01-02 13:02:18', $model->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2019-01-02 13:02:18', $model->getExecutedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2019-02-01 13:02:18', $model->getExpiresAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayloadForCard()
    {
        $this->expectException(FinBlocksException::class);

        DepositCard::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForCard()
    {
        $model = DepositCard::create();
        $model->setReturnUrl('url');

        $array = $model->httpCreate();

        $this->assertCount(6, $array);
        $this->assertArrayHasKey('to', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('amount', $array);
        $this->assertArrayHasKey('fees', $array);
        $this->assertArrayHasKey('cardId', $array);
        $this->assertArrayHasKey('secureMode', $array);
    }

    public function testUpdateArrayForCard()
    {
        $this->expectException(FinBlocksException::class);

        $model = DepositCard::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForDirectDebit()
    {
        $model = DepositDirectDebit::create();
        $model->setTo('12345678');
        $model->setMandateId('87654321');

        // There's no Getter, please refer to the testCreateArrayForBankWire's method.
        $model->setReturnUrl('url');

        // TODO: Add Label and Tag
        //$model->setLabel('label');
        //$model->setTag('tag');

        $this->assertEquals('12345678', $model->getTo());
        $this->assertEquals('87654321', $model->getMandateId());
        //$this->assertEquals('label', $model->getLabel());
        //$this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayloadForDirectDebit()
    {
        $model = DepositDirectDebit::createFromPayload('{
            "id": "1111",
            "type": "directDebit",
            "nature": "deposit",
            "status": "succeeded",
            "to": "2222",
            "createdAt": "2019-01-02T13:02:18.341Z",
            "executedAt": "2019-01-02T13:02:18.341Z",
            "expiresAt": "2019-02-01T13:02:18.341Z",
            "billingAddress": {
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
            "debitedAmount": {
                "currency": "GBP",
                "amount": 200000
            },
            "creditedAmount": {
                "currency": "GBP",
                "amount": 200000
            },
            "fees": {
                "currency": "GBP",
                "amount": 0
            },
            "mandateId": "3333"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('directDebit', $model->getType());
        $this->assertEquals('deposit', $model->getNature());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('2222', $model->getTo());
        $this->assertEquals('3333', $model->getMandateId());

        $this->assertInstanceOf(Address::class, $model->getBillingAddress());

        $this->assertEquals('3', $model->getBillingAddress()->getFlatNumber());
        $this->assertEquals('28', $model->getBillingAddress()->getBuildingNumber());
        $this->assertEquals(null, $model->getBillingAddress()->getBuildingName());
        $this->assertEquals('Ely Place', $model->getBillingAddress()->getStreet());
        $this->assertEquals(null, $model->getBillingAddress()->getSubStreet());
        $this->assertEquals('London', $model->getBillingAddress()->getTown());
        $this->assertEquals('England', $model->getBillingAddress()->getState());
        $this->assertEquals('EC1N 6TD', $model->getBillingAddress()->getPostcode());
        $this->assertEquals('GBR', $model->getBillingAddress()->getCountry());

        $this->assertInstanceOf(Money::class, $model->getDebitedAmount());
        $this->assertInstanceOf(Money::class, $model->getCreditedAmount());
        $this->assertInstanceOf(Money::class, $model->getFees());

        $this->assertEquals('GBP', $model->getDebitedAmount()->getCurrency());
        $this->assertEquals(200000, $model->getDebitedAmount()->getAmount());

        $this->assertEquals('GBP', $model->getCreditedAmount()->getCurrency());
        $this->assertEquals(200000, $model->getCreditedAmount()->getAmount());

        $this->assertEquals('GBP', $model->getFees()->getCurrency());
        $this->assertEquals(0, $model->getFees()->getAmount());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getExecutedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getExpiresAt());

        $this->assertEquals('2019-01-02 13:02:18', $model->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2019-01-02 13:02:18', $model->getExecutedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2019-02-01 13:02:18', $model->getExpiresAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayloadForDirectDebit()
    {
        $this->expectException(FinBlocksException::class);

        DepositDirectDebit::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForDirectDebit()
    {
        $model = DepositDirectDebit::create();
        $model->setTo('12345678');
        $model->setReturnUrl('url');

        $array = $model->httpCreate();

        $this->assertCount(5, $array);
        $this->assertArrayHasKey('to', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('amount', $array);
        $this->assertArrayHasKey('fees', $array);
        $this->assertArrayHasKey('mandateId', $array);
    }

    public function testUpdateArrayForDirectDebit()
    {
        $this->expectException(FinBlocksException::class);

        $model = DepositDirectDebit::create();
        $model->httpUpdate();
    }
}

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
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('12345678', $model->getTo());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
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
            "amount": {
                "currency": "GBP",
                "amount": 200000
            },
            "reference": "QWERTY"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('bankWire', $model->getType());
        $this->assertEquals('deposit', $model->getNature());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('2222', $model->getTo());
        $this->assertEquals('QWERTY', $model->getReference());

        $this->assertInstanceOf(Money::class, $model->getAmount());

        $this->assertEquals('GBP', $model->getAmount()->getCurrency());
        $this->assertEquals(200000, $model->getAmount()->getAmount());

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

        $this->assertCount(5, $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('to', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('amount', $array);
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
        $model->setReference('87654321');
        $model->setSecureMode(true);

        // There's no Getter, please refer to the testCreateArrayForBankWire's method.
        $model->setReturnUrl('url');

        // TODO: Add Label and Tag
        //$model->setLabel('label');
        //$model->setTag('tag');

        $this->assertEquals('12345678', $model->getTo());
        $this->assertEquals('87654321', $model->getReference());
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
            "amount": {
                "currency": "GBP",
                "amount": 200000
            },
            "reference": "3333"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('card', $model->getType());
        $this->assertEquals('deposit', $model->getNature());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('2222', $model->getTo());
        $this->assertEquals('3333', $model->getReference());

        $this->assertInstanceOf(Money::class, $model->getAmount());

        $this->assertEquals('GBP', $model->getAmount()->getCurrency());
        $this->assertEquals(200000, $model->getAmount()->getAmount());

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

        $this->assertCount(7, $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('to', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('amount', $array);
        $this->assertArrayHasKey('reference', $array);
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
        $model->setReference('87654321');

        // There's no Getter, please refer to the testCreateArrayForBankWire's method.
        $model->setReturnUrl('url');

        // TODO: Add Label and Tag
        //$model->setLabel('label');
        //$model->setTag('tag');

        $this->assertEquals('12345678', $model->getTo());
        $this->assertEquals('87654321', $model->getReference());
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
            "amount": {
                "currency": "GBP",
                "amount": 200000
            },
            "reference": "3333"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('directDebit', $model->getType());
        $this->assertEquals('deposit', $model->getNature());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('2222', $model->getTo());
        $this->assertEquals('3333', $model->getReference());

        $this->assertInstanceOf(Money::class, $model->getAmount());

        $this->assertEquals('GBP', $model->getAmount()->getCurrency());
        $this->assertEquals(200000, $model->getAmount()->getAmount());

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

        $this->assertCount(6, $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('to', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('amount', $array);
        $this->assertArrayHasKey('reference', $array);
    }

    public function testUpdateArrayForDirectDebit()
    {
        $this->expectException(FinBlocksException::class);

        $model = DepositDirectDebit::create();
        $model->httpUpdate();
    }
}

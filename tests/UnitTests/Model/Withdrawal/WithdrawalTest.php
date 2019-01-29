<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Withdrawal;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Withdrawal\Withdrawal;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class WithdrawalTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Withdrawal::create();
        $model->setWalletId('12345678');
        $model->setBankAccountId('87654321');
        $model->setBankWireReference('asdfg qwerty');
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('12345678', $model->getWalletId());
        $this->assertEquals('87654321', $model->getBankAccountId());
        $this->assertEquals('asdfg qwerty', $model->getBankWireReference());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Withdrawal::createFromPayload('{
            "id": "1111",
            "label": "Withdrawal\'s Label",
            "tag": "Withdrawal\'s Tag",
            "status": "succeeded",
            "nature": "withdrawal",
            "walletId": "2222",
            "bankAccountId": "3333",
            "bankWireReference": "qwerty",
            "amount": {
                "currency": "GBP",
                "amount": 100000
            },
            "fees": {
                "currency": "GBP",
                "amount": 0
            },
            "createdAt": "2018-12-31T11:31:34.343Z",
            "executedAt": "2018-12-31T11:31:34.343Z"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('Withdrawal\'s Label', $model->getLabel());
        $this->assertEquals('Withdrawal\'s Tag', $model->getTag());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('withdrawal', $model->getNature());
        $this->assertEquals('2222', $model->getWalletId());
        $this->assertEquals('3333', $model->getBankAccountId());
        $this->assertEquals('qwerty', $model->getBankWireReference());

        $this->assertInstanceOf(Money::class, $model->getAmount());
        $this->assertInstanceOf(Money::class, $model->getFees());

        $this->assertEquals('GBP', $model->getAmount()->getCurrency());
        $this->assertEquals(100000, $model->getAmount()->getAmount());

        $this->assertEquals('GBP', $model->getFees()->getCurrency());
        $this->assertEquals(0, $model->getFees()->getAmount());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getExecutedAt());

        $this->assertEquals('2018-12-31 11:31:34', $model->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2018-12-31 11:31:34', $model->getExecutedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Withdrawal::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $model = Withdrawal::create();

        $array = $model->httpCreate();

        $this->assertCount(7, $array);
        $this->assertArrayHasKey('walletId', $array);
        $this->assertArrayHasKey('bankAccountId', $array);
        $this->assertArrayHasKey('bankWireReference', $array);
        $this->assertArrayHasKey('amount', $array);
        $this->assertArrayHasKey('fees', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);

        $this->assertCount(2, $array['amount']);
        $this->assertArrayHasKey('amount', $array['amount']);
        $this->assertArrayHasKey('currency', $array['amount']);

        $this->assertCount(2, $array['fees']);
        $this->assertArrayHasKey('amount', $array['fees']);
        $this->assertArrayHasKey('currency', $array['fees']);
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Withdrawal::create();
        $model->httpUpdate();
    }
}

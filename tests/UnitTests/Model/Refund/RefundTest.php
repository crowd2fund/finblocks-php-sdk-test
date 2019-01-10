<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Refund;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Refund\Refund;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class RefundTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Refund::create();
        $model->setDebitedWalletId('12345678');
        $model->setCreditedWalletId('87654321');
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('12345678', $model->getDebitedWalletId());
        $this->assertEquals('87654321', $model->getCreditedWalletId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Refund::createFromPayload('{
  "id": "1111",
  "status": "succeeded",
  "nature": "refund",
  "label": "Refund\'s Label",
  "tag": "Refund\'s Tag",
  "debitedWalletId": "2222",
  "creditedWalletId": "3333",
  "debitedFunds": {
    "currency": "GBP",
    "amount": 10000
  },
  "creditedFunds": {
    "currency": "GBP",
    "amount": 0
  },
  "fees": {
    "currency": "GBP",
    "amount": 0
  },
  "createdAt": "2019-01-02T11:27:59.488Z",
  "executedAt": "2019-01-02T11:27:59.488Z"
}');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('refund', $model->getNature());
        $this->assertEquals('Refund\'s Label', $model->getLabel());
        $this->assertEquals('Refund\'s Tag', $model->getTag());
        $this->assertEquals('2222', $model->getDebitedWalletId());
        $this->assertEquals('3333', $model->getCreditedWalletId());

        $this->assertInstanceOf(Money::class, $model->getDebitedFunds());
        $this->assertInstanceOf(Money::class, $model->getCreditedFunds());
        $this->assertInstanceOf(Money::class, $model->getFees());

        $this->assertEquals('GBP', $model->getDebitedFunds()->getCurrency());
        $this->assertEquals(10000, $model->getDebitedFunds()->getAmount());

        $this->assertEquals('GBP', $model->getCreditedFunds()->getCurrency());
        $this->assertEquals(0, $model->getCreditedFunds()->getAmount());

        $this->assertEquals('GBP', $model->getFees()->getCurrency());
        $this->assertEquals(0, $model->getFees()->getAmount());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getExecutedAt());

        $this->assertEquals('2019-01-02 11:27:59', $model->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2019-01-02 11:27:59', $model->getExecutedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Refund::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $model = Refund::create();

        $array = $model->httpCreate();

        $this->assertCount(6, $array);
        $this->assertArrayHasKey('debitedWalletId', $array);
        $this->assertArrayHasKey('creditedWalletId', $array);
        $this->assertArrayHasKey('debitedFunds', $array);
        $this->assertArrayHasKey('fees', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);

        $this->assertCount(2, $array['debitedFunds']);
        $this->assertArrayHasKey('currency', $array['debitedFunds']);
        $this->assertArrayHasKey('amount', $array['debitedFunds']);

        $this->assertCount(2, $array['fees']);
        $this->assertArrayHasKey('currency', $array['fees']);
        $this->assertArrayHasKey('amount', $array['fees']);
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Refund::create();
        $model->httpUpdate();
    }
}

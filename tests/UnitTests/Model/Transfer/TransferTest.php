<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Transfer;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Transfer\Transfer;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class TransferTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Transfer::create();
        $model->setFrom('12345678');
        $model->setTo('87654321');
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('12345678', $model->getFrom());
        $this->assertEquals('87654321', $model->getTo());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Transfer::createFromPayload('{
            "id": "1111",
            "status": "succeeded",
            "nature": "transfer",
            "label": "Transfer\'s Label",
            "tag": "Transfer\'s Tag",
            "from": "2222",
            "to": "3333",
            "amount": {
                "currency": "GBP",
                "amount": 10000
            },
            "createdAt": "2019-01-02T10:09:17.121Z",
            "executedAt": "2019-01-02T10:09:17.121Z"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('transfer', $model->getNature());
        $this->assertEquals('Transfer\'s Label', $model->getLabel());
        $this->assertEquals('Transfer\'s Tag', $model->getTag());
        $this->assertEquals('2222', $model->getFrom());
        $this->assertEquals('3333', $model->getTo());

        $this->assertInstanceOf(Money::class, $model->getAmount());

        $this->assertEquals('GBP', $model->getAmount()->getCurrency());
        $this->assertEquals(10000, $model->getAmount()->getAmount());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $model->getExecutedAt());

        $this->assertEquals('2019-01-02 10:09:17', $model->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2019-01-02 10:09:17', $model->getExecutedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Transfer::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $model = Transfer::create();

        $array = $model->httpCreate();

        $this->assertCount(5, $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('from', $array);
        $this->assertArrayHasKey('to', $array);
        $this->assertArrayHasKey('amount', $array);

        $this->assertCount(2, $array['amount']);
        $this->assertArrayHasKey('currency', $array['amount']);
        $this->assertArrayHasKey('amount', $array['amount']);
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Transfer::create();
        $model->httpUpdate();
    }
}

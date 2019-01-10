<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Money;

use FinBlocks\Exception\FinBlocksException;
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
class MoneyTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Money::create();
        $model->setCurrency('GBP');
        $model->setAmount(10000);

        $this->assertEquals('GBP', $model->getCurrency());
        $this->assertEquals(10000, $model->getAmount());
    }

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Money::createFromPayload('{
  "currency": "GBP",
  "amount": 100000
}');

        $this->assertEquals('GBP', $model->getCurrency());
        $this->assertEquals(100000, $model->getAmount());
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Money::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $model = Money::create();

        $array = $model->httpCreate();

        $this->assertArrayHasKey('currency', $array);
        $this->assertArrayHasKey('amount', $array);
    }

    public function testUpdateArray()
    {
        $model = Money::create();

        $array = $model->httpUpdate();

        $this->assertArrayHasKey('currency', $array);
        $this->assertArrayHasKey('amount', $array);
    }
}

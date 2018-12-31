<?php

namespace FinBlocks\Tests\Model\Money;

use FinBlocks\Model\Money\Money;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
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

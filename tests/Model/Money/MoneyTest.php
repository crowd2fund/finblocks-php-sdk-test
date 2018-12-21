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
    public function testSettersForMoneyModel()
    {
        $model = new Money();
        $model->setCurrency('GBP');
        $model->setAmount(10000);

        $this->assertEquals('GBP', $model->getCurrency());
        $this->assertEquals(10000, $model->getAmount());
    }

    public function testCreateArray()
    {
        $model = new Money();

        $array = $model->httpCreate();

        $this->assertArrayHasKey('currency', $array);
        $this->assertArrayHasKey('amount', $array);
    }

    public function testUpdateArray()
    {
        $model = new Money();

        $array = $model->httpUpdate();

        $this->assertArrayHasKey('currency', $array);
        $this->assertArrayHasKey('amount', $array);
    }
}

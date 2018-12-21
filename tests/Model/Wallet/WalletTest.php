<?php

namespace FinBlocks\Tests\Model\Wallet;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Wallet\Wallet;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 * @version   1.0.0
 */
class WalletTest extends TestCase
{
    public function testSettersForMoneyModel()
    {
        $model = new Wallet();
        $model->setAccountHolderId('accountHolderId');
        $model->setCurrency('GBP');
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('accountHolderId', $model->getAccountHolderId());
        $this->assertEquals('GBP', $model->getCurrency());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());

        $this->assertInstanceOf(Money::class, $model->getBalance());
    }

    public function testCreateArray()
    {
        $model = new Wallet();

        $array = $model->httpCreate();

        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('currency', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = new Wallet();
        $model->httpUpdate();
    }
}

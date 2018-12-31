<?php

namespace FinBlocks\Tests\Model\Withdrawal;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Withdrawal\Withdrawal;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
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

    public function testCreateArray()
    {
        $model = Withdrawal::create();

        $array = $model->httpCreate();

        $this->assertCount(7, $array);
        $this->assertArrayHasKey('walletId', $array);
        $this->assertArrayHasKey('bankAccountId', $array);
        $this->assertArrayHasKey('bankWireReference', $array);
        $this->assertArrayHasKey('debitedFunds', $array);
        $this->assertArrayHasKey('fees', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);

        $this->assertCount(2, $array['debitedFunds']);
        $this->assertArrayHasKey('amount', $array['debitedFunds']);
        $this->assertArrayHasKey('currency', $array['debitedFunds']);

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

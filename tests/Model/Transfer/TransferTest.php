<?php

namespace FinBlocks\Tests\Model\Transfer;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Transfer\Transfer;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class TransferTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Transfer::create();
        $model->setDebitedWalletId('12345678');
        $model->setCreditedWalletId('87654321');
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('12345678', $model->getDebitedWalletId());
        $this->assertEquals('87654321', $model->getCreditedWalletId());
        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateArray()
    {
        $model = Transfer::create();

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

        $model = Transfer::create();
        $model->httpUpdate();
    }
}

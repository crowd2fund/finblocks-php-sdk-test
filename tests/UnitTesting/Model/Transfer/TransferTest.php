<?php

namespace Finblocks\Tests\UnitTesting\Model\Transfer;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Money\Money;
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

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Transfer::createFromPayload('{
  "id": "1111",
  "status": "succeeded",
  "nature": "transfer",
  "label": "Transfer\'s Label",
  "tag": "Transfer\'s Tag",
  "debitedWalletId": "2222",
  "creditedWalletId": "3333",
  "debitedFunds": {
    "currency": "GBP",
    "amount": 11000
  },
  "creditedFunds": {
    "currency": "GBP",
    "amount": 10000
  },
  "fees": {
    "currency": "GBP",
    "amount": 1000
  },
  "createdAt": "2019-01-02T10:09:17.121Z",
  "executedAt": "2019-01-02T10:09:17.121Z"
}');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('succeeded', $model->getStatus());
        $this->assertEquals('transfer', $model->getNature());
        $this->assertEquals('Transfer\'s Label', $model->getLabel());
        $this->assertEquals('Transfer\'s Tag', $model->getTag());
        $this->assertEquals('2222', $model->getDebitedWalletId());
        $this->assertEquals('3333', $model->getCreditedWalletId());

        $this->assertInstanceOf(Money::class, $model->getDebitedFunds());
        $this->assertInstanceOf(Money::class, $model->getCreditedFunds());
        $this->assertInstanceOf(Money::class, $model->getFees());

        $this->assertEquals('GBP', $model->getDebitedFunds()->getCurrency());
        $this->assertEquals(11000, $model->getDebitedFunds()->getAmount());

        $this->assertEquals('GBP', $model->getCreditedFunds()->getCurrency());
        $this->assertEquals(10000, $model->getCreditedFunds()->getAmount());

        $this->assertEquals('GBP', $model->getFees()->getCurrency());
        $this->assertEquals(1000, $model->getFees()->getAmount());

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

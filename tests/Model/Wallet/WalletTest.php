<?php

namespace FinBlocks\Tests\Model\Wallet;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Wallet\Wallet;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class WalletTest extends TestCase
{
    public function testCreateEmptyModelAndSetters()
    {
        $model = Wallet::create();
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

    public function testCreateFilledModelFromJsonPayload()
    {
        $model = Wallet::createFromPayload('{
  "id": "1111",
  "accountHolderId": "2222",
  "currency": "GBP",
  "label": "Wallet\'s Label",
  "tag": "Wallet\'s Tag",
  "balance": {
    "currency": "GBP",
    "amount": 200000
  },
  "createdAt": "2019-01-02T09:51:28.795Z"
}');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('Wallet\'s Label', $model->getLabel());
        $this->assertEquals('Wallet\'s Tag', $model->getTag());
        $this->assertEquals('GBP', $model->getCurrency());

        $this->assertInstanceOf(Money::class, $model->getBalance());

        $this->assertEquals('GBP', $model->getBalance()->getCurrency());
        $this->assertEquals(200000, $model->getBalance()->getAmount());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-02 09:51:28', $model->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Wallet::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArray()
    {
        $model = Wallet::create();

        $array = $model->httpCreate();

        $this->assertArrayHasKey('accountHolderId', $array);
        $this->assertArrayHasKey('currency', $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Wallet::create();
        $model->httpUpdate();
    }
}

<?php

namespace FinBlocks\Tests\Model\Deposit;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Deposit\DepositBankWire;
use FinBlocks\Model\Deposit\DepositCard;
use FinBlocks\Model\Deposit\DepositDirectDebit;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class DepositTest extends TestCase
{
    public function testModelSettersForBankWire()
    {
        $model = new DepositBankWire();
        $model->setCreditedWalletId('12345678');

        // There's no Getter, please refer to the testCreateArrayForBankWire's method.
        $model->setReturnUrl('url');

        // TODO: Add Label and Tag
        //$model->setLabel('label');
        //$model->setTag('tag');

        $this->assertEquals('12345678', $model->getCreditedWalletId());
        //$this->assertEquals('label', $model->getLabel());
        //$this->assertEquals('tag', $model->getTag());
    }

    public function testCreateArrayForBankWire()
    {
        $model = new DepositBankWire();
        $model->setReturnUrl('url');

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('creditedWalletId', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('debitedFunds', $array);
        $this->assertArrayHasKey('fees', $array);
    }

    public function testUpdateArrayForBankWire()
    {
        $this->expectException(FinBlocksException::class);

        $model = new DepositBankWire();
        $model->httpUpdate();
    }

    public function testModelSettersForCard()
    {
        $model = new DepositCard();
        $model->setCreditedWalletId('12345678');
        $model->setCardId('87654321');
        $model->setSecureMode(true);

        // There's no Getter, please refer to the testCreateArrayForBankWire's method.
        $model->setReturnUrl('url');

        // TODO: Add Label and Tag
        //$model->setLabel('label');
        //$model->setTag('tag');

        $this->assertEquals('12345678', $model->getCreditedWalletId());
        $this->assertEquals('87654321', $model->getCardId());
        $this->assertEquals(true, $model->isSecureMode());
        //$this->assertEquals('label', $model->getLabel());
        //$this->assertEquals('tag', $model->getTag());
    }

    public function testCreateArrayForCard()
    {
        $model = new DepositCard();
        $model->setReturnUrl('url');

        $array = $model->httpCreate();

        $this->assertCount(6, $array);
        $this->assertArrayHasKey('creditedWalletId', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('debitedFunds', $array);
        $this->assertArrayHasKey('fees', $array);
        $this->assertArrayHasKey('cardId', $array);
        $this->assertArrayHasKey('secureMode', $array);
    }

    public function testUpdateArrayForCard()
    {
        $this->expectException(FinBlocksException::class);

        $model = new DepositCard();
        $model->httpUpdate();
    }

    public function testModelSettersForDirectDebit()
    {
        $model = new DepositDirectDebit();
        $model->setCreditedWalletId('12345678');
        $model->setMandateId('87654321');

        // There's no Getter, please refer to the testCreateArrayForBankWire's method.
        $model->setReturnUrl('url');

        // TODO: Add Label and Tag
        //$model->setLabel('label');
        //$model->setTag('tag');

        $this->assertEquals('12345678', $model->getCreditedWalletId());
        $this->assertEquals('87654321', $model->getMandateId());
        //$this->assertEquals('label', $model->getLabel());
        //$this->assertEquals('tag', $model->getTag());
    }

    public function testCreateArrayForDirectDebit()
    {
        $model = new DepositDirectDebit();
        $model->setCreditedWalletId('12345678');
        $model->setReturnUrl('url');

        $array = $model->httpCreate();

        $this->assertCount(5, $array);
        $this->assertArrayHasKey('creditedWalletId', $array);
        $this->assertArrayHasKey('returnUrl', $array);
        $this->assertArrayHasKey('debitedFunds', $array);
        $this->assertArrayHasKey('fees', $array);
        $this->assertArrayHasKey('mandateId', $array);
    }

    public function testUpdateArrayForDirectDebit()
    {
        $this->expectException(FinBlocksException::class);

        $model = new DepositDirectDebit();
        $model->httpUpdate();
    }
}

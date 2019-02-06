<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Tests\IntegrationTests\API;

use FinBlocks\Client\HttpResponse;
use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Deposit\DepositBankWire;
use FinBlocks\Model\Deposit\DepositCard;
use FinBlocks\Model\Deposit\DepositDirectDebit;
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Pagination\DepositsPagination;
use FinBlocks\Tests\Traits\AccountHolderTrait;
use FinBlocks\Tests\Traits\BankAccountTrait;
use FinBlocks\Tests\Traits\CardTrait;
use FinBlocks\Tests\Traits\DepositTrait;
use FinBlocks\Tests\Traits\MandateTrait;
use FinBlocks\Tests\Traits\WalletTrait;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class DepositsTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use BankAccountTrait;
    use CardTrait;
    use DepositTrait;
    use MandateTrait;
    use WalletTrait;

    public function testCardDeposit()
    {
        $accountHolder = $this->finBlocks->api()->accountHolders()->create(
            $this->traitCreateAccountHolderIndividualModel($this->finBlocks)
        );

        $wallet = $this->finBlocks->api()->wallets()->create(
            $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId())
        );

        $card = $this->finBlocks->api()->cards()->create(
            $this->traitCreateCardModel($this->finBlocks, $accountHolder->getId())
        );

        /** @var DepositCard $deposit */
        $deposit = $this->finBlocks->api()->deposits()->create(
            $this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet->getId(), $wallet->getCurrency())
        );

        $this->assertInstanceOf(DepositCard::class, $deposit);
        $this->assertInstanceOf(\DateTime::class, $deposit->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $deposit->getExecutedAt());
        $this->assertInstanceOf(\DateTime::class, $deposit->getExpiresAt());
        $this->assertInstanceOf(Money::class, $deposit->getAmount());

        $this->assertNotEmpty($deposit->getId());

        $this->assertEquals(DepositCard::TYPE, $deposit->getType());
        $this->assertEquals(DepositCard::NATURE, $deposit->getNature());
        $this->assertEquals(DepositCard::STATUS_DEPOSITED, $deposit->getStatus());
        $this->assertEquals($wallet->getId(), $deposit->getTo());
        $this->assertEquals($card->getId(), $deposit->getReference());
        $this->assertEquals(10000, $deposit->getAmount()->getAmount());
        $this->assertEquals($wallet->getCurrency(), $deposit->getAmount()->getCurrency());
        $this->assertFalse($deposit->isSecureMode());

        $reloadedDeposit = $this->finBlocks->api()->deposits()->show($deposit->getId());

        $this->assertInstanceOf(DepositCard::class, $reloadedDeposit);

        $this->assertEquals($deposit->getId(), $reloadedDeposit->getId());
    }

    public function testCardDepositForInvalidAmount()
    {
        $accountHolder = $this->finBlocks->api()->accountHolders()->create(
            $this->traitCreateAccountHolderIndividualModel($this->finBlocks)
        );

        $wallet = $this->finBlocks->api()->wallets()->create(
            $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId())
        );

        $card = $this->finBlocks->api()->cards()->create(
            $this->traitCreateCardModel($this->finBlocks, $accountHolder->getId())
        );

        $deposit = $this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet->getId(), $wallet->getCurrency());
        $deposit->getAmount()->setAmount(-100);

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->deposits()->create($deposit);
    }

    public function testCardDepositForInvalidCurrency()
    {
        $accountHolder = $this->finBlocks->api()->accountHolders()->create(
            $this->traitCreateAccountHolderIndividualModel($this->finBlocks)
        );

        $wallet = $this->finBlocks->api()->wallets()->create(
            $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId())
        );

        $card = $this->finBlocks->api()->cards()->create(
            $this->traitCreateCardModel($this->finBlocks, $accountHolder->getId())
        );

        $deposit = $this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet->getId(), $wallet->getCurrency());
        $deposit->getAmount()->setCurrency('EUR');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->deposits()->create($deposit);
    }

    public function testBankWireDeposit()
    {
        $accountHolder = $this->finBlocks->api()->accountHolders()->create(
            $this->traitCreateAccountHolderIndividualModel($this->finBlocks)
        );

        $wallet = $this->finBlocks->api()->wallets()->create(
            $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId())
        );

        /** @var DepositBankWire $deposit */
        $deposit = $this->finBlocks->api()->deposits()->create(
            $this->traitCreateBankWireDeposit($this->finBlocks, $wallet->getId(), $wallet->getCurrency())
        );

        $this->assertInstanceOf(DepositBankWire::class, $deposit);
        $this->assertInstanceOf(\DateTime::class, $deposit->getCreatedAt());
        $this->assertNull($deposit->getExecutedAt()); // NULL due to is not yet executed // $this->assertInstanceOf(\DateTime::class, $deposit->getExecutedAt());
        $this->assertInstanceOf(\DateTime::class, $deposit->getExpiresAt());
        $this->assertInstanceOf(Money::class, $deposit->getAmount());

        $this->assertNotEmpty($deposit->getId());

        $this->assertEquals(DepositBankWire::TYPE, $deposit->getType());
        $this->assertEquals(DepositBankWire::NATURE, $deposit->getNature());
        $this->assertEquals(DepositBankWire::STATUS_REQUESTED, $deposit->getStatus());
        $this->assertEquals($wallet->getId(), $deposit->getTo());
        $this->assertEquals(10000, $deposit->getAmount()->getAmount());
        $this->assertEquals($wallet->getCurrency(), $deposit->getAmount()->getCurrency());

        $reloadedDeposit = $this->finBlocks->api()->deposits()->show($deposit->getId());

        $this->assertInstanceOf(DepositBankWire::class, $reloadedDeposit);

        $this->assertEquals($deposit->getId(), $reloadedDeposit->getId());
    }

    public function testBankWireDepositForInvalidAmount()
    {
        $accountHolder = $this->finBlocks->api()->accountHolders()->create(
            $this->traitCreateAccountHolderIndividualModel($this->finBlocks)
        );

        $wallet = $this->finBlocks->api()->wallets()->create(
            $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId())
        );

        $deposit = $this->traitCreateBankWireDeposit($this->finBlocks, $wallet->getId(), $wallet->getCurrency());
        $deposit->getAmount()->setAmount(-100);

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->deposits()->create($deposit);
    }

    public function testBankWireDepositForInvalidCurrency()
    {
        $accountHolder = $this->finBlocks->api()->accountHolders()->create(
            $this->traitCreateAccountHolderIndividualModel($this->finBlocks)
        );

        $wallet = $this->finBlocks->api()->wallets()->create(
            $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId())
        );

        $deposit = $this->traitCreateBankWireDeposit($this->finBlocks, $wallet->getId(), $wallet->getCurrency());
        $deposit->getAmount()->setCurrency('EUR');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->deposits()->create($deposit);
    }

    public function testDirectDebitDeposit()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder = $this->finBlocks->api()->accountHolders()->create(
            $this->traitCreateAccountHolderIndividualModel($this->finBlocks)
        );

        $wallet = $this->finBlocks->api()->wallets()->create(
            $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId())
        );

        $bankAccount = $this->finBlocks->api()->bankAccounts()->create(
            $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId())
        );

        $mandate = $this->finBlocks->api()->mandates()->create(
            $this->traitCreateMandateModel($this->finBlocks, $bankAccount->getId())
        );

        /** @var DepositDirectDebit $deposit */
        $deposit = $this->finBlocks->api()->deposits()->create(
            $this->traitCreateDirectDebitDepositModel($this->finBlocks, $mandate->getId(), $wallet->getId(), $wallet->getCurrency())
        );

        $this->assertInstanceOf(DepositDirectDebit::class, $deposit);
        $this->assertInstanceOf(\DateTime::class, $deposit->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $deposit->getExecutedAt());
        $this->assertInstanceOf(\DateTime::class, $deposit->getExpiresAt());
        $this->assertInstanceOf(Money::class, $deposit->getAmount());

        $this->assertNotEmpty($deposit->getId());

        $this->assertEquals(DepositDirectDebit::TYPE, $deposit->getType());
        $this->assertEquals(DepositDirectDebit::NATURE, $deposit->getNature());
        $this->assertEquals(DepositDirectDebit::STATUS_DEPOSITED, $deposit->getStatus());
        $this->assertEquals($wallet->getId(), $deposit->getTo());
        $this->assertEquals(10000, $deposit->getAmount()->getAmount());
        $this->assertEquals($wallet->getCurrency(), $deposit->getAmount()->getCurrency());

        $reloadedDeposit = $this->finBlocks->api()->deposits()->show($deposit->getId());

        $this->assertInstanceOf(DepositDirectDebit::class, $reloadedDeposit);

        $this->assertEquals($deposit->getId(), $reloadedDeposit->getId());
    }

    public function testDirectDebitDepositForInvalidAmount()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder = $this->finBlocks->api()->accountHolders()->create(
            $this->traitCreateAccountHolderIndividualModel($this->finBlocks)
        );

        $wallet = $this->finBlocks->api()->wallets()->create(
            $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId())
        );

        $bankAccount = $this->finBlocks->api()->bankAccounts()->create(
            $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId())
        );

        $mandate = $this->finBlocks->api()->mandates()->create(
            $this->traitCreateMandateModel($this->finBlocks, $bankAccount->getId())
        );

        $deposit = $this->traitCreateDirectDebitDepositModel($this->finBlocks, $mandate->getId(), $wallet->getId(), $wallet->getCurrency());
        $deposit->getAmount()->setAmount(-100);

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->deposits()->create($deposit);
    }

    public function testDirectDebitDepositForInvalidCurrency()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder = $this->finBlocks->api()->accountHolders()->create(
            $this->traitCreateAccountHolderIndividualModel($this->finBlocks)
        );

        $wallet = $this->finBlocks->api()->wallets()->create(
            $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId())
        );

        $bankAccount = $this->finBlocks->api()->bankAccounts()->create(
            $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId())
        );

        $mandate = $this->finBlocks->api()->mandates()->create(
            $this->traitCreateMandateModel($this->finBlocks, $bankAccount->getId())
        );

        $deposit = $this->traitCreateDirectDebitDepositModel($this->finBlocks, $mandate->getId(), $wallet->getId(), $wallet->getCurrency());
        $deposit->getAmount()->setCurrency('EUR');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->deposits()->create($deposit);
    }

    public function testRetrieveNonExistingDeposit()
    {
        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->deposits()->show('invalid-deposit-id');
    }

    //TODO ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    public function testPaginatedCards()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet1 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId()));
        $wallet2 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId()));

        $this->traitCreateBankWireDeposit($this->finBlocks, $wallet1->getId(), $wallet1->getCurrency());
        $this->traitCreateBankWireDeposit($this->finBlocks, $wallet1->getId(), $wallet2->getCurrency());

        $deposits = $this->finBlocks->api()->deposits()->list(1, 2);

        $this->assertInstanceOf(DepositsPagination::class, $deposits);

        $this->assertGreaterThanOrEqual(2, $deposits->getTotal());

        $this->assertCount(2, $deposits->getItems());
    }

    public function testPaginatedCardsWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->deposits()->list(-1);
    }

    public function testPaginatedCardsWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->deposits()->list(1, -1);
    }

    public function testPaginatedCardsWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->deposits()->list(1, 10000);
    }

    public function testPaginatedCardsByAccountHolder()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet1 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId()));
        $wallet2 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId()));

        $this->traitCreateBankWireDeposit($this->finBlocks, $wallet1->getId(), $wallet1->getCurrency());
        $this->traitCreateBankWireDeposit($this->finBlocks, $wallet1->getId(), $wallet2->getCurrency());

        $deposits1 = $this->finBlocks->api()->deposits()->listByWallet($accountHolder1->getId());
        $deposits2 = $this->finBlocks->api()->deposits()->listByWallet($accountHolder2->getId());

        $this->assertInstanceOf(DepositsPagination::class, $deposits1);
        $this->assertInstanceOf(DepositsPagination::class, $deposits2);

        $this->assertEquals(1, $deposits1->getTotal());
        $this->assertEquals(1, $deposits2->getTotal());

        $this->assertCount(1, $deposits1->getItems());
        $this->assertCount(1, $deposits2->getItems());
    }

    public function testPaginatedCardsByAccountHolderWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->deposits()->listByWallet('id', -1);
    }

    public function testPaginatedCardsByAccountHolderWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->deposits()->listByWallet('id', 1, -1);
    }

    public function testPaginatedCardsByAccountHolderWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->deposits()->listByWallet('id', 1, 10000);
    }
}

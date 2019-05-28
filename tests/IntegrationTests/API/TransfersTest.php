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
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Pagination\TransfersPagination;
use FinBlocks\Model\Transfer\Transfer;
use FinBlocks\Tests\Traits\AccountHolderTrait;
use FinBlocks\Tests\Traits\CardTrait;
use FinBlocks\Tests\Traits\DepositTrait;
use FinBlocks\Tests\Traits\WalletTrait;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class TransfersTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use CardTrait;
    use DepositTrait;
    use WalletTrait;

    public function testMakeTransferBetweenTwoWallets()
    {
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet1 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId()));
        $wallet2 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId()));

        $card = $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder1->getId()));

        $this->finBlocks->api()->deposits()->create($this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet1->getId()));

        sleep(5);

        $transfer = $this->finBlocks->factories()->transfers()->create();
        $transfer->setFrom($wallet1->getId());
        $transfer->setTo($wallet2->getId());
        $transfer->setLabel('Testing transfers');
        $transfer->setTag('test');
        $transfer->getAmount()->setAmount(10000);
        $transfer->getAmount()->setCurrency($wallet1->getCurrency());
        $transfer = $this->finBlocks->api()->transfers()->create($transfer);

        $this->assertInstanceOf(Transfer::class, $transfer);
        $this->assertInstanceOf(Money::class, $transfer->getAmount());
        $this->assertInstanceOf(\DateTime::class, $transfer->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $transfer->getExecutedAt());

        $this->assertNotEmpty($transfer->getId());

        $this->assertEquals('received', $transfer->getStatus());
        $this->assertEquals(Transfer::NATURE, $transfer->getNature());
        $this->assertEquals('Testing transfers', $transfer->getLabel());
        $this->assertEquals('test', $transfer->getTag());
        $this->assertEquals($wallet1->getId(), $transfer->getFrom());
        $this->assertEquals($wallet2->getId(), $transfer->getTo());
        $this->assertEquals(10000, $transfer->getAmount()->getAmount());
        $this->assertEquals($wallet1->getCurrency(), $transfer->getAmount()->getCurrency());

        $reloadedTransfer = $this->finBlocks->api()->transfers()->show($transfer->getId());

        $this->assertEquals($transfer->getId(), $reloadedTransfer->getId());
    }

    public function testMakeTransferBetweenTwoWalletsWithTheMinimumRequiredData()
    {
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet1 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId()));
        $wallet2 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId()));

        $card = $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder1->getId()));

        $this->finBlocks->api()->deposits()->create($this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet1->getId()));

        sleep(5);

        $transfer = $this->finBlocks->factories()->transfers()->create();
        $transfer->setFrom($wallet1->getId());
        $transfer->setTo($wallet2->getId());
        $transfer->getAmount()->setAmount(10000);
        $transfer->getAmount()->setCurrency($wallet1->getCurrency());
        $transfer = $this->finBlocks->api()->transfers()->create($transfer);

        $this->assertInstanceOf(Transfer::class, $transfer);
        $this->assertInstanceOf(Money::class, $transfer->getAmount());
        $this->assertInstanceOf(\DateTime::class, $transfer->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $transfer->getExecutedAt());

        $this->assertNotEmpty($transfer->getId());

        $this->assertNull($transfer->getLabel());
        $this->assertNull($transfer->getTag());

        $this->assertEquals('received', $transfer->getStatus());
        $this->assertEquals(Transfer::NATURE, $transfer->getNature());
        $this->assertEquals($wallet1->getId(), $transfer->getFrom());
        $this->assertEquals($wallet2->getId(), $transfer->getTo());
        $this->assertEquals(10000, $transfer->getAmount()->getAmount());
        $this->assertEquals($wallet1->getCurrency(), $transfer->getAmount()->getCurrency());

        $reloadedTransfer = $this->finBlocks->api()->transfers()->show($transfer->getId());

        $this->assertEquals($transfer->getId(), $reloadedTransfer->getId());
    }

    public function testMakeTransferToTheSameWallet()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId()));

        $card = $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder->getId()));

        $this->finBlocks->api()->deposits()->create($this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet->getId()));

        $transfer = $this->finBlocks->factories()->transfers()->create();
        $transfer->setFrom($wallet->getId());
        $transfer->setTo($wallet->getId());
        $transfer->getAmount()->setAmount(10000);
        $transfer->getAmount()->setCurrency($wallet->getCurrency());

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->transfers()->create($transfer);
    }

    public function testMakeTransferWithoutEnoughFunds()
    {
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet1 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId()));
        $wallet2 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId()));

        $transfer = $this->finBlocks->factories()->transfers()->create();
        $transfer->setFrom($wallet1->getId());
        $transfer->setTo($wallet2->getId());
        $transfer->getAmount()->setAmount(10000);
        $transfer->getAmount()->setCurrency($wallet1->getCurrency());

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->transfers()->create($transfer);
    }

    public function testMakeTransferWithoutAmount()
    {
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet1 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId()));
        $wallet2 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId()));

        $card = $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder1->getId()));

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->deposits()->create($this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet1->getId()));

        $transfer = $this->finBlocks->factories()->transfers()->create();
        $transfer->setFrom($wallet1->getId());
        $transfer->setTo($wallet2->getId());
        $transfer->getAmount()->setAmount(0);
        $transfer->getAmount()->setCurrency($wallet1->getCurrency());

        $this->finBlocks->api()->transfers()->create($transfer);
    }

    public function testMakeTransferWithNegativeAmount()
    {
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet1 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId()));
        $wallet2 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId()));

        $card = $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder1->getId()));

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->deposits()->create($this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet1->getId()));

        $transfer = $this->finBlocks->factories()->transfers()->create();
        $transfer->setFrom($wallet1->getId());
        $transfer->setTo($wallet2->getId());
        $transfer->getAmount()->setAmount(-10000);
        $transfer->getAmount()->setCurrency($wallet1->getCurrency());

        $this->finBlocks->api()->transfers()->create($transfer);
    }

    public function testRetrieveNonExistingTransfer()
    {
        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->transfers()->show('non-existing-id');
    }

    public function testListAllTransfers()
    {
        $this->markTestSkipped('Not yet implemented');
    }

    public function testListAllTransfersWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->transfers()->list(-1);
    }

    public function testListAllTransfersWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->transfers()->list(1, -10);
    }

    public function testListAllTransfersWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->transfers()->list(1, 10000);
    }

    public function testListAllTransfersForTheGivenWallet()
    {
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));
        $accountHolder3 = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet1 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId()));
        $wallet2 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId()));
        $wallet3 = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder3->getId()));

        $card1 = $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder1->getId()));
        $card2 = $this->finBlocks->api()->cards()->create($this->traitCreateCardModel($this->finBlocks, $accountHolder2->getId()));

        $this->markTestSkipped('Not yet implemented');

        $this->finBlocks->api()->deposits()->create($this->traitCreateCardDepositModel($this->finBlocks, $card1->getId(), $wallet1));
        $this->finBlocks->api()->deposits()->create($this->traitCreateCardDepositModel($this->finBlocks, $card2->getId(), $wallet2));

        $transfer1 = $this->finBlocks->factories()->transfers()->create();
        $transfer1->setFrom($wallet1->getId());
        $transfer1->setTo($wallet3->getId());
        $transfer1->getAmount()->setAmount(10000);
        $transfer1->getAmount()->setCurrency($wallet1->getCurrency());

        $this->finBlocks->api()->transfers()->create($transfer1);

        $transfer2 = $this->finBlocks->factories()->transfers()->create();
        $transfer2->setFrom($wallet2->getId());
        $transfer2->setTo($wallet3->getId());
        $transfer2->getAmount()->setAmount(10000);
        $transfer2->getAmount()->setCurrency($wallet2->getCurrency());

        $this->finBlocks->api()->transfers()->create($transfer2);

        $allTransfers1 = $this->finBlocks->api()->transfers()->listByWallet($wallet1->getId());
        $allTransfers2 = $this->finBlocks->api()->transfers()->listByWallet($wallet2->getId());
        $allTransfers3 = $this->finBlocks->api()->transfers()->listByWallet($wallet3->getId());

        $this->assertInstanceOf(TransfersPagination::class, $allTransfers1);
        $this->assertInstanceOf(TransfersPagination::class, $allTransfers2);
        $this->assertInstanceOf(TransfersPagination::class, $allTransfers3);

        $this->assertCount(1, $allTransfers1->getItems());
        $this->assertCount(1, $allTransfers2->getItems());
        $this->assertCount(2, $allTransfers3->getItems());
    }

    public function testListAllTransfersForTheGivenWalletWithInvalidPage()
    {
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId()));

        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->transfers()->listByWallet($wallet->getId(), -1);
    }

    public function testListAllTransfersForTheGivenWalletWithLowerPerPage()
    {
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId()));

        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->transfers()->listByWallet($wallet->getId(), 1, -10);
    }

    public function testListAllTransfersForTheGivenWalletWithGreaterPerPage()
    {
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($this->traitCreateAccountHolderIndividualModel($this->finBlocks));

        $wallet = $this->finBlocks->api()->wallets()->create($this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId()));

        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->transfers()->listByWallet($wallet->getId(), 1, 10000);
    }
}

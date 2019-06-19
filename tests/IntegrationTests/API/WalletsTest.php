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
use FinBlocks\Model\Deposit\DepositCard;
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Pagination\WalletsPagination;
use FinBlocks\Model\Wallet\Wallet;
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
class WalletsTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use CardTrait;
    use DepositTrait;
    use WalletTrait;

    public function testCreateWallet()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $model = $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId());

        $returnedContent = $this->finBlocks->api()->wallets()->create($model);

        $this->assertInstanceOf(Wallet::class, $returnedContent);

        $this->assertNotEmpty('string', $returnedContent->getId());

        $this->assertEquals($accountHolder->getId(), $returnedContent->getAccountHolderId());
        $this->assertEquals('GBP', $returnedContent->getCurrency());
        $this->assertEquals('Label for Wallet', $returnedContent->getLabel());
        $this->assertEquals('Tag for Wallet', $returnedContent->getTag());

        $this->assertInstanceOf(Money::class, $returnedContent->getBalance());

        $this->assertEquals('GBP', $returnedContent->getBalance()->getCurrency());
        $this->assertEquals(0, $returnedContent->getBalance()->getAmount());

        $this->assertInstanceOf(\DateTime::class, $returnedContent->getCreatedAt());

        $reloadedContent = $this->finBlocks->api()->wallets()->show($returnedContent->getId());

        $this->assertInstanceOf(Wallet::class, $reloadedContent);

        $this->assertEquals($returnedContent->getId(), $reloadedContent->getId());
        $this->assertEquals($returnedContent->getAccountHolderId(), $reloadedContent->getAccountHolderId());
        $this->assertEquals($returnedContent->getCurrency(), $reloadedContent->getCurrency());
        $this->assertEquals($returnedContent->getLabel(), $reloadedContent->getLabel());
        $this->assertEquals($returnedContent->getTag(), $reloadedContent->getTag());
        $this->assertEquals($returnedContent->getBalance()->getCurrency(), $reloadedContent->getBalance()->getCurrency());
        $this->assertEquals($returnedContent->getBalance()->getAmount(), $reloadedContent->getBalance()->getAmount());
        $this->assertEquals($returnedContent->getCreatedAt(), $reloadedContent->getCreatedAt());
    }

    public function testCreateWalletJustForMandatoryFields()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $model = $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId(), true);

        $returnedContent = $this->finBlocks->api()->wallets()->create($model);

        $this->assertInstanceOf(Wallet::class, $returnedContent);

        $this->assertNotEmpty('string', $returnedContent->getId());

        $this->assertEquals($accountHolder->getId(), $returnedContent->getAccountHolderId());
        $this->assertEquals('GBP', $returnedContent->getCurrency());
        $this->assertEquals(null, $returnedContent->getLabel());
        $this->assertEquals(null, $returnedContent->getTag());
    }

    public function testCreateAnIncompleteWallet()
    {
        $model = $this->finBlocks->factories()->wallets()->create();

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->wallets()->create($model);
    }

    public function testCreateWalletForNonExistingAccountHolder()
    {
        $model = $this->traitCreateWalletModel($this->finBlocks, 'accountholder-00000000-096b-4401-8df6-ec5c2cb6bb55');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $this->finBlocks->api()->wallets()->create($model);
    }

    public function testRetrieveNonExistingWallet()
    {
        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->wallets()->show('non-existing-id');
    }

    public function testGetPaginatedWallets()
    {
        $this->markTestSkipped('Not yet implemented');

        $returnedContent = $this->finBlocks->api()->wallets()->list(1, 1);

        $this->assertInstanceOf(WalletsPagination::class, $returnedContent);
        $this->assertInternalType('array', $returnedContent->getItems());
        $this->assertInstanceOf(Wallet::class, $returnedContent->getItems()[0]);
    }

    public function testGetPaginatedWalletsWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->wallets()->list(-1);
    }

    public function testGetPaginatedWalletsWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->wallets()->list(1, -1);
    }

    public function testGetPaginatedWalletsWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->wallets()->list(1, 10000);
    }

    public function testListAllByAccountHolder()
    {
        $this->markTestSkipped('Not yet implemented');

        $accountHolder1 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($accountHolder1);

        $accountHolder2 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($accountHolder2);

        $wallet1 = $this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId());
        $this->finBlocks->api()->wallets()->create($wallet1);

        $wallet2 = $this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId());
        $this->finBlocks->api()->wallets()->create($wallet2);

        $returnedContent = $this->finBlocks->api()->wallets()->listByAccountHolder($accountHolder1->getId());

        $this->assertInstanceOf(WalletsPagination::class, $returnedContent);
        $this->assertEquals(1, $returnedContent->getTotal());
    }

    public function testListAllByAccountHolderWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $this->finBlocks->api()->wallets()->listByAccountHolder($accountHolder->getId(), -1);
    }

    public function testListAllByAccountHolderWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $this->finBlocks->api()->wallets()->listByAccountHolder($accountHolder->getId(), 1, -1);
    }

    public function testListAllByAccountHolderWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $this->finBlocks->api()->wallets()->listByAccountHolder($accountHolder->getId(), 1, 10000);
    }

    public function testWalletFullStatement()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $wallet1 = $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId());
        $wallet1 = $this->finBlocks->api()->wallets()->create($wallet1);

        $wallet2 = $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId());
        $wallet2 = $this->finBlocks->api()->wallets()->create($wallet2);

        $card = $this->traitCreateCardModel($this->finBlocks, $accountHolder->getId());
        $card = $this->finBlocks->api()->cards()->create($card);

        $deposit1 = $this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet1->getId(), $wallet1->getCurrency());
        $deposit1 = $this->finBlocks->api()->deposits()->create($deposit1);

        $deposit2 = $this->traitCreateCardDepositModel($this->finBlocks, $card->getId(), $wallet1->getId(), $wallet1->getCurrency());
        $deposit2 = $this->finBlocks->api()->deposits()->create($deposit2);

        sleep(5);

        $transfer = $this->finBlocks->factories()->transfers()->create();
        $transfer->setFrom($wallet1->getId());
        $transfer->setTo($wallet2->getId());
        $transfer->setLabel('Wallet-to-Wallet transfer');
        $transfer->setTag('test');
        $transfer->getAmount()->setAmount(100);
        $transfer->getAmount()->setCurrency($wallet1->getCurrency());
        $transfer = $this->finBlocks->api()->transfers()->create($transfer);

        sleep(1);

        // ----

        $wallet1 = $this->finBlocks->api()->wallets()->show($wallet1->getId());
        $wallet2 = $this->finBlocks->api()->wallets()->show($wallet2->getId());

        $this->assertEquals(19900, $wallet1->getBalance()->getAmount());
        $this->assertEquals(100, $wallet2->getBalance()->getAmount());

        $statement1 = $this->finBlocks->api()->wallets()->statement($wallet1->getId(), 1, 2);
        $statement2 = $this->finBlocks->api()->wallets()->statement($wallet1->getId(), 2, 2);
        $statement3 = $this->finBlocks->api()->wallets()->statement($wallet2->getId());

        $this->assertEquals(3, $statement1->getTotal());
        $this->assertEquals(0, $statement1->getSkip());
        $this->assertEquals(2, $statement1->getLimit());
        $this->assertCount(2, $statement1->getItems());
        $this->assertEquals($deposit1->getNature(), $statement1->getItems()[0]->getNature());
        $this->assertEquals($deposit1->getId(), $statement1->getItems()[0]->getId());
        $this->assertEquals($deposit2->getNature(), $statement1->getItems()[1]->getNature());
        $this->assertEquals($deposit2->getId(), $statement1->getItems()[1]->getId());

        $this->assertEquals(3, $statement2->getTotal());
        $this->assertEquals(2, $statement2->getSkip());
        $this->assertEquals(2, $statement2->getLimit());
        $this->assertCount(1, $statement2->getItems());
        $this->assertEquals($transfer->getNature(), $statement2->getItems()[0]->getNature());
        $this->assertEquals($transfer->getId(), $statement2->getItems()[0]->getId());

        $this->assertEquals(1, $statement3->getTotal());
        $this->assertEquals(0, $statement3->getSkip());
        $this->assertEquals(10, $statement3->getLimit());
        $this->assertCount(1, $statement3->getItems());
        $this->assertEquals($transfer->getNature(), $statement3->getItems()[0]->getNature());
        $this->assertEquals($transfer->getId(), $statement3->getItems()[1]->getId());
    }
}

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

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Pagination\WalletsPagination;
use FinBlocks\Model\Wallet\Wallet;
use FinBlocks\Tests\Traits\AccountHolderTrait;

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

    public function testCreateWallet()
    {
        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $model = $this->finBlocks->factories()->wallets()->create();
        $model->setAccountHolderId($accountHolder->getId());
        $model->setCurrency('GBP');
        $model->setLabel('Wallet\'s Label');
        $model->setTag('Wallet\'s Tag');

        $returnedContent = $this->finBlocks->api()->wallets()->create($model);

        $this->assertInstanceOf(Wallet::class, $returnedContent);

        $this->assertNotEmpty('string', $returnedContent->getId());

        $this->assertEquals($accountHolder->getId(), $returnedContent->getAccountHolderId());
        $this->assertEquals('GBP', $returnedContent->getCurrency());
        $this->assertEquals('Wallet\'s Label', $returnedContent->getLabel());
        $this->assertEquals('Wallet\'s Tag', $returnedContent->getTag());

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

        $model = $this->finBlocks->factories()->wallets()->create();
        $model->setAccountHolderId($accountHolder->getId());
        $model->setCurrency('GBP');

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
        $this->expectException(FinBlocksException::class);

        $model = $this->finBlocks->factories()->wallets()->create();

        $this->finBlocks->api()->wallets()->create($model);
    }

    public function testCreateWalletForNonExistingAccountHolder()
    {
        $this->expectException(FinBlocksException::class);

        $model = $this->finBlocks->factories()->wallets()->create();
        $model->setAccountHolderId('accountholder-00000000-096b-4401-8df6-ec5c2cb6bb55');
        $model->setCurrency('GBP');
        $model->setLabel('label');
        $model->setTag('tag');

        $this->finBlocks->api()->wallets()->create($model);
    }

    public function testRetrieveNonExistingWallet()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->wallets()->show('non-existing-id');
    }

    public function testGetPaginatedWallets()
    {
        $returnedContent = $this->finBlocks->api()->wallets()->list(1, 1);

        $this->assertInstanceOf(WalletsPagination::class, $returnedContent);
        $this->assertInternalType('array', $returnedContent->getEmbedded());
        $this->assertInstanceOf(Wallet::class, $returnedContent->getEmbedded()[0]);
    }

    public function testInvalidArgumentsForPaginatedAccountHolders()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->wallets()->list(-1);
    }
}

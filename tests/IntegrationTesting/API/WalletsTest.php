<?php

namespace FinBlocks\Tests\IntegrationTesting\API;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;
use FinBlocks\Model\AccountHolder\Company\Company;
use FinBlocks\Model\Address\Address;
use FinBlocks\Model\Money\Money;
use FinBlocks\Model\Pagination\AccountHoldersPagination;
use FinBlocks\Model\Pagination\WalletsPagination;
use FinBlocks\Model\Wallet\Wallet;

class WalletsTest extends AbstractApiTests
{
    public function testCreateWallet()
    {
        $model = $this->finBlocks->factories()->wallets()->create();
        $model->setAccountHolderId('accountholder-e5e2ad73-096b-4401-8df6-ec5c2cb6bb55');
        $model->setCurrency('GBP');
        $model->setLabel('Wallet\'s Label');
        $model->setTag('Wallet\'s Tag');

        $returnedContent = $this->finBlocks->api()->wallets()->create($model);

        $this->assertInstanceOf(Wallet::class, $returnedContent);

        $this->assertNotEmpty('string', $returnedContent->getId());

        $this->assertEquals('accountholder-e5e2ad73-096b-4401-8df6-ec5c2cb6bb55', $returnedContent->getAccountHolderId());
        $this->assertEquals('GBP', $returnedContent->getCurrency());
        $this->assertEquals('Wallet\'s Label', $returnedContent->getLabel());
        $this->assertEquals('Wallet\'s Tag', $returnedContent->getTag());

        $this->assertInstanceOf(Money::class, $returnedContent->getBalance());

        //TODO: Remove comment and restore assets
        //$this->assertEquals('GBP', $returnedContent->getBalance()->getCurrency());
        //$this->assertEquals(0, $returnedContent->getBalance()->getAmount());

        //TODO: Remove comment and restore asset
        //$this->assertInstanceOf(\DateTime::class, $returnedContent->getCreatedAt());

        $reloadedContent = $this->finBlocks->api()->wallets()->show($returnedContent->getId());

        $this->assertInstanceOf(Wallet::class, $reloadedContent);

        $this->assertEquals($returnedContent->getId(), $reloadedContent->getId());
        $this->assertEquals($returnedContent->getAccountHolderId(), $reloadedContent->getAccountHolderId());
        $this->assertEquals($returnedContent->getCurrency(), $reloadedContent->getCurrency());
        $this->assertEquals($returnedContent->getLabel(), $reloadedContent->getLabel());
        $this->assertEquals($returnedContent->getTag(), $reloadedContent->getTag());
        //TODO: Remove comment and restore assets
        //$this->assertEquals($returnedContent->getBalance()->getCurrency(), $reloadedContent->getBalance()->getCurrency());
        //$this->assertEquals($returnedContent->getBalance()->getAmount(), $reloadedContent->getBalance()->getAmount());
        //$this->assertEquals($returnedContent->getCreatedAt(), $reloadedContent->getCreatedAt());
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
}

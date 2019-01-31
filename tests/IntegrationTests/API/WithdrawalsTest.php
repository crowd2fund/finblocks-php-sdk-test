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
use FinBlocks\Model\Pagination\Links;
use FinBlocks\Model\Pagination\WithdrawalsPagination;
use FinBlocks\Model\Withdrawal\Withdrawal;
use FinBlocks\Tests\Traits\AccountHolderTrait;
use FinBlocks\Tests\Traits\BankAccountTrait;
use FinBlocks\Tests\Traits\WalletTrait;
use FinBlocks\Tests\Traits\WithdrawalTrait;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class WithdrawalsTest extends AbstractApiTests
{
    use AccountHolderTrait;
    use BankAccountTrait;
    use WalletTrait;
    use WithdrawalTrait;

    public function testCreateWithdrawal()
    {
        $this->markTestIncomplete('Not yet implemented');

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $wallet = $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId());
        $wallet = $this->finBlocks->api()->wallets()->create($wallet);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $withdrawal = $this->traitCreateWithdrawalModel($this->finBlocks, $bankAccount->getId(), $wallet->getId(), $wallet->getCurrency());
        $withdrawal = $this->finBlocks->api()->withdrawals()->create($withdrawal);

        $this->assertInstanceOf(Withdrawal::class, $withdrawal);
        $this->assertInstanceOf(Money::class, $withdrawal->getAmount());
        $this->assertInstanceOf(Money::class, $withdrawal->getFees());
        $this->assertInstanceOf(\DateTime::class, $withdrawal->getCreatedAt());

        $this->assertNotEmpty($withdrawal->getId());

        $this->assertEquals($wallet->getId(), $withdrawal->getWalletId());
        $this->assertEquals($bankAccount->getId(), $withdrawal->getBankAccountId());
        $this->assertEquals('reference', $withdrawal->getBankWireReference());
        $this->assertEquals('Withdrawal Label', $withdrawal->getLabel());
        $this->assertEquals('Withdrawal Tag', $withdrawal->getTag());
        $this->assertEquals(Withdrawal::STATUS_CREATED, $withdrawal->getStatus());
        $this->assertEquals(Withdrawal::NATURE, $withdrawal->getNature());
        $this->assertEquals(null, $withdrawal->getExecutedAt());

        $reloadedWithdrawal = $this->finBlocks->api()->withdrawals()->show($withdrawal->getId());

        $this->assertInstanceOf(Withdrawal::class, $reloadedWithdrawal);

        $this->assertEquals($withdrawal->getId(), $reloadedWithdrawal->getId());
    }

    public function testCreateWithdrawalWithNonExistingWalletId()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $withdrawal = $this->traitCreateWithdrawalModel($this->finBlocks, $bankAccount->getId(), 'invalid-wallet-id');
        $this->finBlocks->api()->withdrawals()->create($withdrawal);
    }

    public function testCreateWithdrawalWithNonExistingBankAccountId()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $wallet = $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId());
        $wallet = $this->finBlocks->api()->wallets()->create($wallet);

        $withdrawal = $this->traitCreateWithdrawalModel($this->finBlocks, 'invalid-bank-account-id', $wallet->getId(), $wallet->getCurrency());
        $this->finBlocks->api()->withdrawals()->create($withdrawal);
    }

    public function testCreateWithdrawalWithInvalidWalletIdAndBankAccountId()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        // Account Holder + Wallet + Bank Account for the first Account Holder

        $accountHolder1 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($accountHolder1);

        $bankAccount1 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder1->getId());
        $bankAccount1 = $this->finBlocks->api()->bankAccounts()->create($bankAccount1);

        // Account Holder + Wallet + Bank Account for the second Account Holder

        $accountHolder2 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($accountHolder2);

        $wallet2 = $this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId());
        $wallet2 = $this->finBlocks->api()->wallets()->create($wallet2);

        // Withdrawal

        $withdrawal = $this->traitCreateWithdrawalModel($this->finBlocks, $bankAccount1->getId(), $wallet2->getId(), $wallet2->getCurrency());

        $this->finBlocks->api()->withdrawals()->create($withdrawal);
    }

    public function testCreateWithdrawalWithInvalidAmount()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::BAD_REQUEST);

        $accountHolder = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder = $this->finBlocks->api()->accountHolders()->create($accountHolder);

        $wallet = $this->traitCreateWalletModel($this->finBlocks, $accountHolder->getId());
        $wallet = $this->finBlocks->api()->wallets()->create($wallet);

        $bankAccount = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder->getId());
        $bankAccount = $this->finBlocks->api()->bankAccounts()->create($bankAccount);

        $withdrawal = $this->traitCreateWithdrawalModel($this->finBlocks, $bankAccount->getId(), $wallet->getId(), $wallet->getCurrency());
        $withdrawal->getAmount()->setAmount(0);
        $this->finBlocks->api()->withdrawals()->create($withdrawal);
    }

    public function testRetrieveNonExistingWithdrawal()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);
        $this->expectExceptionCode(HttpResponse::NOT_FOUND);

        $this->finBlocks->api()->withdrawals()->show('non-existing-id');
    }

    public function testListPaginatedWithdrawals()
    {
        $this->markTestIncomplete('Not yet implemented');

        // Account Holder + Wallet + Bank Account + Withdrawal for the first Account Holder

        $accountHolder1 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($accountHolder1);

        $wallet1 = $this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId());
        $wallet1 = $this->finBlocks->api()->wallets()->create($wallet1);

        $bankAccount1 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder1->getId());
        $bankAccount1 = $this->finBlocks->api()->bankAccounts()->create($bankAccount1);

        $withdrawal1 = $this->traitCreateWithdrawalModel($this->finBlocks, $bankAccount1->getId(), $wallet1->getId(), $wallet1->getCurrency());
        $this->finBlocks->api()->withdrawals()->create($withdrawal1);

        // Account Holder + Wallet + Bank Account + Withdrawal for the second Account Holder

        $accountHolder2 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($accountHolder2);

        $wallet2 = $this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId());
        $wallet2 = $this->finBlocks->api()->wallets()->create($wallet2);

        $bankAccount2 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder2->getId());
        $bankAccount2 = $this->finBlocks->api()->bankAccounts()->create($bankAccount2);

        $withdrawal2 = $this->traitCreateWithdrawalModel($this->finBlocks, $bankAccount2->getId(), $wallet2->getId(), $wallet2->getCurrency());
        $this->finBlocks->api()->withdrawals()->create($withdrawal2);

        // Paginated results for the first Account Holder

        $paginatedList = $this->finBlocks->api()->withdrawals()->list(1, 1);

        $this->assertInstanceOf(WithdrawalsPagination::class, $paginatedList);
        $this->assertInstanceOf(Links::class, $paginatedList->getLinks());

        $this->assertCount(1, $paginatedList->getItems());

        $this->assertGreaterThanOrEqual(2, $paginatedList->getTotal());
    }

    public function testListPaginatedWithdrawalsWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->withdrawals()->list(-1);
    }

    public function testListPaginatedWithdrawalsWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->withdrawals()->list(1, -1);
    }

    public function testListPaginatedWithdrawalsWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->withdrawals()->list(1, 10000);
    }

    public function testListPaginatedWithdrawalsByWallet()
    {
        $this->markTestIncomplete('Not yet implemented');

        // Account Holder + Wallet + Bank Account + Withdrawal for the first Account Holder

        $accountHolder1 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder1 = $this->finBlocks->api()->accountHolders()->create($accountHolder1);

        $wallet1 = $this->traitCreateWalletModel($this->finBlocks, $accountHolder1->getId());
        $wallet1 = $this->finBlocks->api()->wallets()->create($wallet1);

        $bankAccount1 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder1->getId());
        $bankAccount1 = $this->finBlocks->api()->bankAccounts()->create($bankAccount1);

        $withdrawal1 = $this->traitCreateWithdrawalModel($this->finBlocks, $bankAccount1->getId(), $wallet1->getId(), $wallet1->getCurrency());
        $this->finBlocks->api()->withdrawals()->create($withdrawal1);

        // Account Holder + Wallet + Bank Account + Withdrawal for the second Account Holder

        $accountHolder2 = $this->traitCreateAccountHolderIndividualModel($this->finBlocks);
        $accountHolder2 = $this->finBlocks->api()->accountHolders()->create($accountHolder2);

        $wallet2 = $this->traitCreateWalletModel($this->finBlocks, $accountHolder2->getId());
        $wallet2 = $this->finBlocks->api()->wallets()->create($wallet2);

        $bankAccount2 = $this->traitCreateBankAccountGbModel($this->finBlocks, $accountHolder2->getId());
        $bankAccount2 = $this->finBlocks->api()->bankAccounts()->create($bankAccount2);

        $withdrawal2 = $this->traitCreateWithdrawalModel($this->finBlocks, $bankAccount2->getId(), $wallet2->getId(), $wallet2->getCurrency());
        $this->finBlocks->api()->withdrawals()->create($withdrawal2);

        // Paginated results for the first Account Holder

        $paginatedList = $this->finBlocks->api()->withdrawals()->listByWallet($wallet1->getId());

        $this->assertInstanceOf(WithdrawalsPagination::class, $paginatedList);
        $this->assertInstanceOf(Links::class, $paginatedList->getLinks());

        $this->assertCount(1, $paginatedList->getItems());

        $this->assertEquals(1, $paginatedList->getTotal());
        $this->assertEquals($withdrawal1->getId(), $paginatedList->getItems()[0]->getId());
    }

    public function testListPaginatedWithdrawalsByWalletWithInvalidWalletId()
    {
        $this->markTestIncomplete('Not yet implemented');

        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->withdrawals()->listByWallet('invalid-wallet-id');
    }

    public function testListPaginatedWithdrawalsByWalletWithInvalidPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->withdrawals()->listByWallet('wallet-id', -1);
    }

    public function testListPaginatedWithdrawalsByWalletWithLowerPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->withdrawals()->listByWallet('wallet-id', 1, -1);
    }

    public function testListPaginatedWithdrawalsByWalletWithGreaterPerPage()
    {
        $this->expectException(FinBlocksException::class);

        $this->finBlocks->api()->withdrawals()->listByWallet('wallet-id', 1, 10000);
    }
}

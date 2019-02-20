<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Factory;

use FinBlocks\Factory;
use FinBlocks\FinBlocks;
use FinBlocks\Model;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class FactoryTest extends TestCase
{
    /**
     * @var FinBlocks
     */
    private $finBlocks;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->finBlocks = new FinBlocks('', '', '', true);
    }

    public function testAccountHoldersFactory()
    {
        $this->assertInstanceOf(Factory\AccountHoldersFactory::class, $this->finBlocks->factories()->accountHolders());
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderIndividual::class, $this->finBlocks->factories()->accountHolders()->createIndividual());
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderIndividual::class, $this->finBlocks->factories()->accountHolders()->createIndividualFromPayload(''));
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderBusiness::class, $this->finBlocks->factories()->accountHolders()->createBusiness());
        $this->assertInstanceOf(Model\AccountHolder\AccountHolderBusiness::class, $this->finBlocks->factories()->accountHolders()->createBusinessFromPayload(''));
    }

    public function testBankAccountsFactory()
    {
        $this->assertInstanceOf(Factory\BankAccountsFactory::class, $this->finBlocks->factories()->bankAccounts());
        $this->assertInstanceOf(Model\BankAccount\BankAccountCa::class, $this->finBlocks->factories()->bankAccounts()->createCa());
        $this->assertInstanceOf(Model\BankAccount\BankAccountCa::class, $this->finBlocks->factories()->bankAccounts()->createCaFromPayload(''));
        $this->assertInstanceOf(Model\BankAccount\BankAccountGb::class, $this->finBlocks->factories()->bankAccounts()->createGb());
        $this->assertInstanceOf(Model\BankAccount\BankAccountGb::class, $this->finBlocks->factories()->bankAccounts()->createGbFromPayload(''));
        $this->assertInstanceOf(Model\BankAccount\BankAccountIban::class, $this->finBlocks->factories()->bankAccounts()->createIban());
        $this->assertInstanceOf(Model\BankAccount\BankAccountIban::class, $this->finBlocks->factories()->bankAccounts()->createIbanFromPayload(''));
        $this->assertInstanceOf(Model\BankAccount\BankAccountOther::class, $this->finBlocks->factories()->bankAccounts()->createOther());
        $this->assertInstanceOf(Model\BankAccount\BankAccountOther::class, $this->finBlocks->factories()->bankAccounts()->createOtherFromPayload(''));
        $this->assertInstanceOf(Model\BankAccount\BankAccountUs::class, $this->finBlocks->factories()->bankAccounts()->createUs());
        $this->assertInstanceOf(Model\BankAccount\BankAccountUs::class, $this->finBlocks->factories()->bankAccounts()->createUsFromPayload(''));
    }

    public function testCardsFactory()
    {
        $this->assertInstanceOf(Factory\CardsFactory::class, $this->finBlocks->factories()->cards());
        $this->assertInstanceOf(Model\Card\Card::class, $this->finBlocks->factories()->cards()->create());
        $this->assertInstanceOf(Model\Card\Card::class, $this->finBlocks->factories()->cards()->createFromPayload(''));
    }

    public function testDepositsFactory()
    {
        $this->assertInstanceOf(Factory\DepositsFactory::class, $this->finBlocks->factories()->deposits());
        $this->assertInstanceOf(Model\Deposit\DepositBankWire::class, $this->finBlocks->factories()->deposits()->createBankWire());
        $this->assertInstanceOf(Model\Deposit\DepositBankWire::class, $this->finBlocks->factories()->deposits()->createBankWireFromPayload(''));
        $this->assertInstanceOf(Model\Deposit\DepositCard::class, $this->finBlocks->factories()->deposits()->createCard());
        $this->assertInstanceOf(Model\Deposit\DepositCard::class, $this->finBlocks->factories()->deposits()->createCardFromPayload(''));
        $this->assertInstanceOf(Model\Deposit\DepositDirectDebit::class, $this->finBlocks->factories()->deposits()->createDirectDebit());
        $this->assertInstanceOf(Model\Deposit\DepositDirectDebit::class, $this->finBlocks->factories()->deposits()->createDirectDebitFromPayload(''));
    }

    public function testDocumentsFactory()
    {
        $this->assertInstanceOf(Factory\DocumentsFactory::class, $this->finBlocks->factories()->documents());
        $this->assertInstanceOf(Model\Document\DocumentDrivingLicense::class, $this->finBlocks->factories()->documents()->createDrivingLicense());
        $this->assertInstanceOf(Model\Document\DocumentDrivingLicense::class, $this->finBlocks->factories()->documents()->createDrivingLicenseFromPayload(''));
        $this->assertInstanceOf(Model\Document\DocumentIdCard::class, $this->finBlocks->factories()->documents()->createIdCard());
        $this->assertInstanceOf(Model\Document\DocumentIdCard::class, $this->finBlocks->factories()->documents()->createIdCardFromPayload(''));
        $this->assertInstanceOf(Model\Document\DocumentPassport::class, $this->finBlocks->factories()->documents()->createPassportFromPayload(''));
        $this->assertInstanceOf(Model\Document\DocumentPassport::class, $this->finBlocks->factories()->documents()->createPassport());
    }

    public function testHooksFactory()
    {
        $this->assertInstanceOf(Factory\HooksFactory::class, $this->finBlocks->factories()->hooks());
        $this->assertInstanceOf(Model\Hook\Hook::class, $this->finBlocks->factories()->hooks()->create());
        $this->assertInstanceOf(Model\Hook\Hook::class, $this->finBlocks->factories()->hooks()->createFromPayload(''));
        $this->assertInstanceOf(Model\Hook\Callback::class, $this->finBlocks->factories()->hooks()->createCallbackFromPayload('{"eventId":"12345"}'));
    }

    public function testKnowYourCustomersFactory()
    {
        $this->assertInstanceOf(Factory\KnowYourCustomersFactory::class, $this->finBlocks->factories()->kyc());
        $this->assertInstanceOf(Model\KnowYourCustomer\KnowYourCustomer::class, $this->finBlocks->factories()->kyc()->create());
        $this->assertInstanceOf(Model\KnowYourCustomer\KnowYourCustomer::class, $this->finBlocks->factories()->kyc()->createFromPayload(''));
    }

    public function testMandatesFactory()
    {
        $this->assertInstanceOf(Factory\MandatesFactory::class, $this->finBlocks->factories()->mandates());
        $this->assertInstanceOf(Model\Mandate\Mandate::class, $this->finBlocks->factories()->mandates()->create());
        $this->assertInstanceOf(Model\Mandate\Mandate::class, $this->finBlocks->factories()->mandates()->createFromPayload(''));
    }

    public function testRefundsFactory()
    {
        $this->assertInstanceOf(Factory\RefundsFactory::class, $this->finBlocks->factories()->refunds());
        $this->assertInstanceOf(Model\Refund\Refund::class, $this->finBlocks->factories()->refunds()->create());
        $this->assertInstanceOf(Model\Refund\Refund::class, $this->finBlocks->factories()->refunds()->createFromPayload(''));
    }

    public function testTransfersFactory()
    {
        $this->assertInstanceOf(Factory\TransfersFactory::class, $this->finBlocks->factories()->transfers());
        $this->assertInstanceOf(Model\Transfer\Transfer::class, $this->finBlocks->factories()->transfers()->create());
        $this->assertInstanceOf(Model\Transfer\Transfer::class, $this->finBlocks->factories()->transfers()->createFromPayload(''));
    }

    public function testWalletsFactory()
    {
        $this->assertInstanceOf(Factory\WalletsFactory::class, $this->finBlocks->factories()->wallets());
        $this->assertInstanceOf(Model\Wallet\Wallet::class, $this->finBlocks->factories()->wallets()->create());
        $this->assertInstanceOf(Model\Wallet\Wallet::class, $this->finBlocks->factories()->wallets()->createFromPayload(''));
    }

    public function testWithdrawalsFactory()
    {
        $this->assertInstanceOf(Factory\WithdrawalsFactory::class, $this->finBlocks->factories()->withdrawals());
        $this->assertInstanceOf(Model\Withdrawal\Withdrawal::class, $this->finBlocks->factories()->withdrawals()->create());
        $this->assertInstanceOf(Model\Withdrawal\Withdrawal::class, $this->finBlocks->factories()->withdrawals()->createFromPayload(''));
    }
}
